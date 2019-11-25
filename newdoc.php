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

$licnum = strtoupper($_POST["lnum"]);	//get doctor license number from user
$fname = $_POST["fname"];	//get doctor firstname
$lname = $_POST["lname"];	//get doctors last name
$spec= $_POST["spec"];		//get doctors specialty
$licensed = $_POST["license"];	//get doctors date they were licensed
$code = strtoupper($_POST["HospCode"]);	//get doctors hospital code

$query1 = 'SELECT * FROM Doctor WHERE licenseNumber =' ." "."'$licnum'";	//query will check if the license Number already exist
$query2 = 'SELECT * FROM Hospital WHERE uniqueCode = '. "'$code'";		//check to make sure hosp code is valid
$query3 = 'INSERT INTO Doctor(licenseNumber,fname,lname,specialty,dateLicensed,hospCode)VALUES('."'$licnum'".",".checkNull($fname).",".checkNull($lname).",".checkNull($spec).",".checkNull($licensed).","."'$code'".")";

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
	$len1 = 0;

	$res = mysqli_query($connection,$query2);
	if(!res){
		die("Error: insert failed" . mysqli_error($connection));
		mysqli_free_result($res);
	}

	while($row = mysqli_fetch_assoc($res))
	{

		$len1++;
	}
	
	if($len1 == 0)	// no match returned let the user know howspital code isn't valid
	{
		echo 'input valid hospital code';
	}
	else
	{
		$resl = mysqli_query($connection,$query3);
		if(!resl)
		{
			die("database insert failed" . mysqli_error($connection));
			mysqli_free($resl);
		}

		else	//if query doesn't fail doctor should be inserted
		{
			echo "Doctor has been added:"."<br>";
			echo $licnum.", ".$fname.", ".$lname.", ".$spec.", ".$licensed.", ".$code;
		}
	}

}

else	//let user know licenseNumber already exist in database
{
	echo "Doctor already exist in databse, choose another ID";
}

mysqli_close($connection);	//always close connection after done using
	
?>
</body>
</html>
