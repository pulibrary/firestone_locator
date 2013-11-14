<?php

	include_once('phpCAS/CAS.php');
  	// Initialize phpCAS
	phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');
		
	phpCAS::setNoCasServerValidation();
	
	phpCAS::logout();
  	header("Location: ../index.php");


?>
