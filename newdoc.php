<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>NEW Doc</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<?php

$licnum = $_POST["lnum"];	//get doctor license number from user

$query1 = 'SELECT * FROM Doctor WHERE licenseNumber =' ." "."'$licnum'";	//query will check if the license Number already exist

$result = mysqli_query($connection,$query1);
$length = 0;	//will count how many rows we get from query

if(!$result){
        die("Error: insert failed" . mysqli_error($connection));
}

while($row = mysqli_fetch_assoc($result))
{
	$length++;
}

mysqli_free_result($result);

/*
This function takes a variable as paramter
checks if that variable is empty
sets it to NULL if it is,
returns the variable
*/
function checkNull($variable)
{
	$variable = !empty($variable) ? "'$variable'" : "NULL";
	return $variable;
}

//if the first query didn't return a match then license number doesn't exist - create doctor
if($length == 0)
{
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$spec= $_POST["spec"];
	$licensed = $_POST["license"];
	$code = $_POST["hospcode"];

	$query2 = 'INSERT INTO Doctor(licenseNumber,fname,lname,specialty,dateLicensed,hospCode)VALUES('."'$licnum'".",".checkNull($fname).",".checkNull($lname).",".checkNull($spec).",".checkNull($licensed).","."'$code'".")";

	$res = mysqli_query($connection,$query2);
	if(!res){
		die("Error: insert failed" . mysqli_error($connection));
	}
	

	echo "Doctor has been added:"."<br>";
	echo $licnum.", ".$fname.", ".$lname.", ".$spec.", ".$licensed.", ".$code;
	
	mysqli_free_result($res);
}
else	//let user know licenseNumber already exist in database
{
	echo "Doctor already exist in databse, choose another ID";
}

mysqli_close($connection);	//always close connection after done using
	
?>
</body>
</html>
