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
   $patohip= $_POST["patohip2"];	//get ohip from user
   $doclic = $_POST["docLic2"];		//get doc license number from user

	//query stops doctor from treating patient by removing matching pair from treats table

   $query = 'DELETE FROM Treats WHERE ohip ='."'$patohip'".'AND licenseNumber ='."'$doclic'";
   

    $result=mysqli_query($connection,$query);
    if (!$result) {
         die("database query failed. ". mysqli_error($connection));
	mysqli_free_result($result);// got to free query before issuing another query
     }else
        {
		//query to get patient and doctor information to display to user
                $query2 = 'SELECT Patient.fname AS pfname,Patient.lname AS plname,Doctor.lname AS dlname FROM Patient,Doctor WHERE ohip ='."'$patohip'".' AND licenseNumber ='."'$doclic'";
                $res = mysqli_query($connection,$query2);

                if (!$res) {
                        die("database query failed. " . mysqli_error($connection));
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
   mysqli_close($connection);	//always got to close connection after done using.
?>
</body>
</html>
