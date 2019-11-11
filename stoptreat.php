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
   $patohip= $_POST["patohip2"];
   $doclic = $_POST["docLic2"];
   $query = 'DELETE FROM Treats WHERE ohip ='."'$patohip'".'AND licenseNumber ='."'$doclic'";
   

    $result=mysqli_query($connection,$query);
    if (!$result) {
         die("database query failed.");
	mysqli_free_result($result);
     }else
        {
                $query2 = 'SELECT Patient.fname AS pfname,Patient.lname AS plname,Doctor.lname AS dlname FROM Patient,Doctor WHERE ohip ='."'$patohip'".' AND licenseNumber ='."'$doclic'";
                $res = mysqli_query($connection,$query2);

                if (!$res) {
                        die("database query failed.");
                }
		while($row = mysqli_fetch_assoc($res))
		{
			echo '<br>';
			echo "Doctor ".$row["dlname"]." is no more treating ".$row["pfname"]." ".$row["plname"];
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
