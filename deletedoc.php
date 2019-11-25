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

//list of all queries needed to accomplish task
$query1 = 'SELECT * FROM Hospital WHERE headDoctor = '."'$lnum'";
$query2 = 'SELECT Treats.ohip FROM Treats WHERE Treats.licenseNumber = '."'$lnum'";	//check if doctor is treating a patient

$result = mysqli_query($connection,$query1);

$length = 0;    //will count how many rows we get from query

if(!$result){
        die("Error: selection failed" . mysqli_error($connection));	//let the user know what went wrong
}
	//successful query


	while($row = mysqli_fetch_assoc($result))
	{
        	$length++;
	}	

	mysqli_free_result($result);	


	if($length != 0)	//if we get rows returned then doctor is a head doctor
	{

		echo 'Cannot delete a head doctor';

	}
	else
	{

                $len = 0;

                $resl = mysqli_query($connection,$query2);	//store result of query 2 in $res1

                if(!$resl){
                        die("Error: selection failed" . mysqli_error($connection));
                }

                while($row1 = mysqli_fetch_assoc($resl))
                {
                        $len++;	//increment by number of rows returned
                }

                mysqli_free_result($resl);

                //if we get a row returned then user is trying to delete a doctor who isn't a head , but is treating a patient
                if($len != 0)
                {
                     
			echo 'Doctor You are trying to delete is currently treating a patient, would you stil like to delete doctor: '.'<br>';
			echo '<br>';
			echo '<form action="finaldelete.php" method="post">';
			echo '<input type="radio" name="choice" value='."'$lnum'".'>'."Yes".'<br>';
			echo '<input type="radio" name="choice" value="no">'."No".'<br>';
			echo '<input type="submit" value="Continue">';
			echo '</form>';
		}
		else	//doctor isn't a head doctor and isn't treating any patients
		{
			//create a form that ask the user if they would like to continue to delete the doctor and get thier response
			echo 'Are you sure you want to delete doctor?';
			echo '<br>';
                	echo '<form action="finaldelete.php" method="post">';
                	echo '<input type="radio" name="choice" value='."'$lnum'".'>'."Yes".'<br>';
                	echo '<input type="radio" name="choice" value="no">'."No".'<br>';
                	echo '<input type="submit" value="Continue">';
                	echo '</form>';
		
		}
	}


?>
<?php
mysqli_close($connection);	//always close connection after done using 
?>
</body>
</html>
