<?php
 
// import phpCAS lib

include_once('phpCAS/CAS/CAS.php');

phpCAS::setDebug("/tmp/cas.log");

// initialize phpCAS
phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');

// force CAS authentication
phpCAS::forceAuthentication();

// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().

// logout if desired

if (isset($_REQUEST['logout'])) {
      phpCAS::logout();
}




?>