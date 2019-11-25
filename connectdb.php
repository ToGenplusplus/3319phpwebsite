<?php	//this file is used to initialize a connection to database
$dbhost = "localhost";
$dbuser= "root";
$dbpass = "AwesomeGod1";
$dbname = "towoajeassign2db";
$connection = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);
if (mysqli_connect_errno()) {
     die("database connection failed :" .
     mysqli_connect_error() .
     "(" . mysqli_connect_errno() . ")"
         );
    }
?>
