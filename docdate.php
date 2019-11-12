<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Doctors before date</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<ol>
<?php

        $beforeDate = strval($_POST["dates"]);	//get date from user

        $query1 = 'SELECT fname,lname,specialty,dateLicensed FROM Doctor WHERE dateLicensed <' ." "."'$beforeDate'";
        echo '<strong>'.'All the doctors licensed before '.'</strong>'.$beforeDate.':';
        echo '<br>';
	echo '<br>';
	echo '<br>';


        $res = mysqli_query($connection,$query1);
        if (!$res) {
        die("databases query failed.");
        }
	//after successful query

        while($row1 = mysqli_fetch_assoc($res))
        {
		echo "<li>";
                echo $row1["fname"]." ". $row1["lname"]."	".$row1["specialty"]."		".$row1["dateLicensed"]."<br>";

        }
	echo '<br>';

        mysqli_free_result($res);
?>
</ol>
<?php
   mysqli_close($connection);	//always close connection after done using.
?>
</body>
</html>
