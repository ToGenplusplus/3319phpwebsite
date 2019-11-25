<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Doc</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<?php

$choice = $_POST["choice"];	//get user choice no or if yes $choice will 
				//contain doctor license number
		
if($choice == "no")
{

	echo 'Doctor was not deleted';	//user decides not to continue to delete doctor

}
else	//user decides to continue
{

$query3 = 'DELETE FROM Doctor WHERE licenseNumber = '."'$choice'";	//query to delete doctor specified by license Number

$result3 = mysqli_query($connection,$query3);

if(!$result3){	//if error with query
	die("Error: deletion failed" . mysqli_error($connection));
        mysqli_free_result($result3);
}

echo 'Doctor has been successfully deleted from database';	//let the user know doctor has been succseflly deleted

}

?>
</body>
</html>
