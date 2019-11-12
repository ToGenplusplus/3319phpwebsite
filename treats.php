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

   $query = 'INSERT INTO Treats VALUES('."'$patohip'".","."'$doclic'".' )';
  
    $result=mysqli_query($connection,$query);

    if (!$result) {
         die("database query failed.");
	 mysqli_free_result($result);	//got to free a result of one query before issuing another	 
     }else
	{

		$query2 = 'SELECT Patient.fname AS pfname,Patient.lname AS plname,Doctor.fname AS dfname FROM Patient,Doctor WHERE Patient.ohip ='."'$patohip,".'AND Doctor.licenseNumber ='."'$doclic'";		
		$res=mysqli_query($connection,$query2);

		if (!$res) {
         		die("database query failed.");
     		}

		while ($row=mysqli_fetch_assoc($res)) {
       			echo 'Doctor '.$row["dfname"].'is now treating'.$row["pfname"]." ".$row["plname"];
     		}

     		mysqli_free_result($res);	
	}
    
?>
</ol>
<?php
   mysqli_close($connection);
?>
</body>
</html>
