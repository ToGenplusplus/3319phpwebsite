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

$fname = $_POST["fname"];	//get doctors first name from user
$lname= $_POST["lname"];       //get doctor last name from user

$query1 = 'SELECT Treats.ohip FROM Treats, Doctor WHERE Treats.licenseNumber = Doctor.licenseNumber AND fname LIKE '. "'%$fname%'".' AND lname LIKE '."'%$lname%'";

echo $query1;
echo '<br>';

$result = mysqli_query($connection,$query1);

$length = 0;    //will count how many rows we get from query

if(!$result){
        die("Error: insert failed" . mysqli_error($connection));
}
else
{

	while($row = mysqli_fetch_assoc($result))
	{
        	$length++;
	}	

	mysqli_free_result($result);	

	if(lenght != 0)
	{
		echo 'Doctor You are trying to delete is currently treating a patient, would you stil like to delete doctor: '.'<br>';

	}
	else
	{
		$query2 = 'SELECT Treats.ohip FROM Treats, Doctor, Hospital WHERE Treats.licenseNumber = Doctor.licenseNumber AND Doctor.licenseNumber = headDoctor AND fname LIKE '."'%$fname%'". ' AND lname LIKE '."'%$lname%'";

		$len = 0;

		$result2 = mysqli_query($connection,$query2);
		
		if(!$result2){
        		die("Error: insert failed" . mysqli_error($connection));
		}

		while($row1 = mysqli_fetch_assoc($result2))
        	{
                	$len++;
        	}		

		mysqli_free_result($result2);

		if($len != 0)
		{
			echo 'Cannot delete doctor, doctor is head of a hospital';

		}
		else
		{
			$query3 = 'DELETE FROM Doctor WHERE fname LIKE '."'%$fname%'". ' AND lname LIKE '."'%$lname%'";

			$result3 = mysqli_query($connection,$query3);

			if(!$result3){
        			die("Error: insert failed" . mysqli_error($connection));
			}
					
			echo 'Doctor has been successfully deleted from database';

			mysqli_free_result($result3);
		}
	}

}
?>
<?php
mysqli_close($connection);
?>
</body>
</html>
