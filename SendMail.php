<?php
	#include_once "db_fns.php";
	$sender  = trim($_POST['name']);
	$email   = trim($_POST['email']);
	$comment = trim($_POST['com']);
	$bib     = trim($_POST['bib']);
	//refdesk@princeton.edu 
	//$to 		= "jlogan@princeton.edu,refdesk@princeton.edu,kr2@princeton.edu";
  $to       = "refdesk@princeton.edu";
	$subject 	= "Locator Comment";
	$body 		= "Sender: $sender \n Contact info: $email \n Comment: $comment \n Item bib: $bib";

	//var_dump($_POST);
	if (mail($to, $subject, $body, "From: $email")) {
  		echo("Message successfully sent!");
 	} else {
  		echo("Message delivery failed... Please contact the reference desk directly at refdesk@princeton.edu");
 	}

?>
