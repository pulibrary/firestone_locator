<?php
/**
 * DB Config 
 *
 */
include("db_config.php");
function db_backup($env="stage") {
	global $dbconnects, $db_settings, $db_tools;
	
	$date = str_replace (" ", "", date("m-d-Y.H:i"));
	$file = "locator.$env." . $date .".sql";
	$out1 = $db_tools["mysqldump"]." --host=".$db_settings[$env.'host']." --user=".$db_settings['username']." --password=".$db_settings['password']." locator_$env > ../sql-files/$file";
	exec($out1,$output,$returncode);
	if ($returncode!=0) {
		echo "<div class='messages error'><div class='message-icon'><i class='fa fa-exclamation-triangle' /></div><div class='message'>An error occured, the file $file could not be backed up.</div></div>";
		return false;
	} else {
		echo "<div class='messages status'><div class='message-icon'><i class='fa fa-check' /></div><div class='message'>The $env database has been backed up to $file.</div></div>";
		return $file;
	}

}

function db_restore($file, $env="stage") {
	global $dbconnects, $db_settings, $db_tools;
	
	$out1 = $db_tools["mysql"]." --host=".$db_settings[$env.'host']." --user=".$db_settings['username']." --password=".$db_settings['password']." locator_$env < ../sql-files/$file";
	exec($out1,$output,$returncode);
	if ($returncode!=0) {
		echo "<div class='messages error'><div class='message-icon'><i class='fa fa-exclamation-triangle' /></div><div class='message'>An error occured, the file $file could not be restored.  No change has been made to the $env environment.</div></div>";
		return false;
	} else {
		echo "<div class='messages status'><div class='message-icon'><i class='fa fa-check' /></div><div class='message'>The $env database has been restored from $file.</div></div>";
		return $file;
	}	
}

function db_deploy() {
	global $dbconnects, $db_settings, $db_tools;
	$stageFile = db_backup("stage");
	$prodFile = db_backup("production");
	if (!$stageFile||!$prodFile) {
		echo "<div class='messages error'><div class='message-icon'><i class='fa fa-exclamation-triangle' /></div><div class='message'>Deployment stopped because no backups were saved.  Cannot proceed.</div></div>";
		return false;
	
	} else {
		$out1 = $db_tools["mysql"]." --host=".$db_settings['productionhost']." --user=".$db_settings['username']." --password=".$db_settings['password']." locator_production < ../sql-files/$stageFile";
		exec($out1,$output,$returncode);
		if ($returncode!=0) {
			echo "<div class='messages error'><div class='message-icon'><i class='fa fa-exclamation-triangle' /></div><div class='message'>An error occured, the stage environment could not be deployed.  No change has been made to the production environment.</div></div>";
			return false;
		} else {
			echo "<div class='messages status'><div class='message-icon'><i class='fa fa-check' /></div><div class='message'>The stage environment has been deployed to production.  Both environments have been backed up.</div></div>";
			move_files();
			return true;
		}		
	}
	

}
function move_files() {
	global $dbconnects, $db_settings, $db_tools;
	
	$file_list = array();
	$image_selects[] = "SELECT DISTINCT Image_cn from lctr_Octavos_cn order by Image_cn";
	$image_selects[] = "SELECT DISTINCT Image_cn from lctr_Oversize_cn order by Image_cn";
	$image_selects[] = "SELECT DISTINCT Image_cn from lctr_Collections_cn order by Image_cn";
	#$image_selects[] = "SELECT DISTINCT Image_cn from lctr_Coordinates_cn order by Image_cn";
	foreach ($image_selects as $imageSQL) {
		if ($fileResult = $dbconnects["stage"]->query($imageSQL)) {
			$i = 1;
			while ($fileRecord = $fileResult->fetch_assoc()) {
				$fileRecord;
				if (array_search($fileRecord["Image_cn"],$file_list)===false) {
					$file_list[] = $fileRecord["Image_cn"];
					$i++;
				}
			}
		} else {
			
		}
	}
	exec("rm ../images/production/f/*",$output,$returncode);
	if ($returncode!=0) {
		echo "<div class='messages error'><div class='message-icon'><i class='fa fa-exclamation-triangle' /></div><div class='message'>An error occured, the production image files could not be removed.</div></div>";
		return false;
	} else {
		$i = 1;
		$j = 0;
		$errors ="";
		foreach ($file_list as $imageFile) {
			if (!file_exists("../images/stage/f/$imageFile")) {
				$error = true;
				$j++;
				$errors .= "<li>".$imageFile." not found</li>\n";
			} else if (!copy("../images/stage/f/$imageFile", "../images/production/f/$imageFile")) {
				$error = true;
				$j++;
				$errors .= "<li>$imageFile copy failed</li>\n";
			} else {
				$filename = pathinfo("../images/stage/f/$imageFile");
				if (!copy("../images/stage/f/".$filename["filename"].".png", "../images/production/f/".$filename["filename"].".png")) {
					$error=true;
					$errors .= "<li>".$filename["filename"].".PNG copy failed</li>\n";
				
				} else {
					$i++;
				}
			}
		}
		foreach (glob("../images/stage/f/legend*") as $legendFile) {
			$lf = pathinfo($legendFile);
			if (!copy("../images/stage/f/".$lf["basename"], "../images/production/f/$".$lf["basename"])) {
				$error = true;
				$j++;
				$errors .= "<li>".$lf["basename"]." copy failed</li>\n";
			} else {
				$i++;
			}
		}
		
		if ($error) {
			echo "<div class='messages error'><div class='message-icon'><i class='fa fa-exclamation-triangle' /></div><div class='message'>$j files were not copied from stage to production.<ul>$errors</ul></div></div>";
		}
		echo "<div class='messages status'><div class='message-icon'><i class='fa fa-check' /></div><div class='message'>$i files of ".sizeof($file_list)." were copied from stage to production.</div></div>";
		return true;
	}
	
}
function db_backuplist() {
	$files = scandir("../sql-files", 1);
	$prod_files = array();
	$stage_files = array();
	foreach ($files as $fil) {
		$filInfo = explode(".",$fil);
		if ($filInfo[1]=="production") {
			$prod_filename[] = $fil;
			$prod_files[] = str_replace("-","/",$filInfo[2])." - ".$filInfo[3];
		} else if ($filInfo[1]=="stage") {
			$stage_filename[] = $fil;
			$stage_files[] = str_replace("-","/",$filInfo[2])." - ".$filInfo[3];
		}
	}
	echo "<div class='indent'><p>Choose from the below backup times - only the most 10 recent are shown.</p>\n";
	echo "<p>Note, choosing to restore a file will also create a backup</p>\n";
	echo "<form action='#' method='POST' id='prod_form'>\n";
	echo "<h3>Restore a Production DB</h3>\n";
	echo "<label>Backup: </label> <select name='file' id='prod_select'>\n";
	echo "<option value='' selected='selected'>Select</option>\n";
	$i=0;
	for ($i=0;$i<10;$i++) {
		if (isset($prod_filename[$i])) {
			echo "<option value='$prod_filename[$i]'>$prod_files[$i]</option>\n";
		} else {
			break;
		}
	}
	echo "</select><input type='hidden' value='production' name='env' /><input type='button' value='Restore' id='prod_sub'  class='btn' />\n";
	echo "</form>\n";

	
	echo "<form action='#' method='POST' id='stage_form'>\n";
	echo "<h3>Restore a Stage DB</h3>\n";
	echo "<label>Backup: </label> <select name='file' id='stage_select'>\n";
	echo "<option value='' selected='selected'>Select</option>\n";
	$i=0;
	for ($i=0;$i<10;$i++) {
		if (isset($stage_filename[$i])) {
			echo "<option value='$stage_filename[$i]'>$stage_files[$i]</option>\n";
		} else {
		break;
		}
	}
	echo "</select><input type='hidden' value='stage' name='env' /><input type='button' value='Restore' id='stage_sub'  class='btn' />\n";
	echo "</form>\n";
	
}


?>