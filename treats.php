<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<ol>
<?php
   $patohip= $_POST["patohip1"];	//get patient ohip from user
   $doclic = $_POST["docLic"];		// get doctor licenseNumber from user
 
	//query to assign doctor to a patient by inserting pair into treats table

   $query = 'INSERT INTO Treats(ohip,licenseNumber)VALUES('."'$patohip'".","."'$doclic'".')';
   
   $result=mysqli_query($connection,$query);

    if (!$result) {
         die("database query failed." . mysqli_error($connection));
	 mysqli_free_result($result);	//got to free a result of one query before issuing another	 
     }else
	{
		//query to display doctors new patient
		$query2 = 'SELECT Patient.fname AS pfname,Patient.lname AS plname,Doctor.lname AS dlname FROM Patient,Doctor WHERE Patient.ohip = '."'$patohip'".'AND Doctor.licenseNumber = '."'$doclic'";
		
		$res=mysqli_query($connection,$query2);

		if (!$res) {
			echo 'this query failed';
         		die("database query failed. " . mysqli_error($connection));
     		}

		while ($row=mysqli_fetch_assoc($res)) {
       			echo 'Doctor '.$row["dlname"].' is now treating '.$row["pfname"]." ".$row["plname"];	//let the user know doctor is now treating patient
     		}

     		mysqli_free_result($res);	
	}
    
?>
</ol>
<?php
   mysqli_close($connection);	//always close connection after done using
?>
</body>
</html>
