<?php
// Site can be found @ https://cs4640.cs.virginia.edu/xtz3mx/pourpro/


// DEBUGGING ONLY! Show all errors.
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Class autoloading by name.  All our classes will be in a directory
// that Apache does not serve publicly.  They will be in /opt/src/, which
// is our src/ directory in Docker.
spl_autoload_register(function ($classname) {
        // include "/opt/src/pourpro/$classname.php";
        // include "/students/jpg5wq/students/jpg5wq/private/pourpro/$classname.php";
        include "/students/xtz3mx/students/xtz3mx/private/pourpro/$classname.php";

});

// Other global things that we need to do
// (such as starting a session, coming soon!)

// Instantiate the front controller
$pourpro = new PourProController($_GET);

// Run the controller
$pourpro->run();