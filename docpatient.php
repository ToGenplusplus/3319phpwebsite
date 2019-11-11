<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Doctor Treating Patient</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<ol>
<?php
   $patohip= $_POST["patohip"];
   
   $query1 = 'SELECT ohip FROM Patient WHERE ohip ='."'$patohip'";
   $result=mysqli_query($connection,$query1);
    if (!$result) {
         die("database query1 failed.");
     }
	$length = 0;
    while ($row=mysqli_fetch_assoc($result)) {
       $length++;
     }
     mysqli_free_result($result);
	if($length ==0)
	{
		echo 'OHIP not in database';
	}
	else
	{
		$query2 = 'SELECT Patient.fname AS pfname,Patient.lname AS plname,Doctor.fname AS dfname,Doctor.lname AS dlname FROM Patient,Doctor,Treats WHERE Patient.ohip = Treats.ohip AND Treats.licenseNumber = Doctor.licenseNumber AND Treats.ohip = '."'$patohip'";
		$res=mysqli_query($connection,$query2);
    		if (!$res) {
         		die("database query2 failed.");
     		}
		while ($row1=mysqli_fetch_assoc($res)) {
       
			echo '<li>';
			echo $row1["pfname"].", ".$row1["plname"].", ".$row1["dfname"].", ".$row1["dlname"].".";
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
