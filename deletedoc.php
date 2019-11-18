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

$lnum  = $_POST["choosedoc"];	//get doctor licenseNumber from user

$query1 = 'SELECT Treats.ohip FROM Treats WHERE Treats.licenseNumber = '."'$lnum'";

$result = mysqli_query($connection,$query1);

$length = 0;    //will count how many rows we get from query

if(!$result){
        die("Error: selection failed" . mysqli_error($connection));
}
else
{

	while($row = mysqli_fetch_assoc($result))
	{
        	$length++;
	}	

	mysqli_free_result($result);	

	//if we get a row doctor is treating patient, inform user.

	if($length != 0)
	{
		echo 'Doctor You are trying to delete is currently treating a patient, would you stil like to delete doctor: '.'<br>';
		echo '<br>';
		echo '<form action="finaldelete.php" method="post">';
		echo '<input type="radio" name="choice" value='."'$lnum'".'>'."Yes".'<br>';
		echo '<input type="radio" name="choice" value="no">'."No".'<br>';
		echo '<input type="submit" value="Continue">';
		echo '</form>';


	}
	else	//if doctor isn't treating a patient
	{
		//this query checks if the doctor is a head doctor

		$query2 = 'SELECT Treats.ohip FROM Treats,Hospital WHERE Treats.licenseNumber = '."'$lnum'".' AND headDoctor = '."'$lunm'";

		$len = 0;

		$result2 = mysqli_query($connection,$query2);
		
		if(!$result2){
        		die("Error: selection failed" . mysqli_error($connection));
		}

		while($row1 = mysqli_fetch_assoc($result2))
        	{
                	$len++;
        	}		

		mysqli_free_result($result2);

		//if we get a row returned then user cannot delete doctor,inform user.
		if($len != 0)
		{
			echo 'Cannot delete doctor, doctor is head of a hospital';

		}
		else	//if doctor not a head doctor and not treating a patient
		{
			$query3 = 'DELETE FROM Doctor WHERE licenseNumber = '."'$lnum'";

			$result3 = mysqli_query($connection,$query3);

			if(!$result3){
        			die("Error: deletion failed" . mysqli_error($connection));
				mysqli_free_result($result3);
			}
			
		
			echo 'Doctor has been successfully deleted from database';

		
		}
	}

}
?>
<?php
mysqli_close($connection);
?>
</body>
</html>
