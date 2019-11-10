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
<h3>Doctors Info:</h3>
<br>

<ol>
<?php

        $beforeDate = strval($_POST["dates"]);

        $query1 = 'SELECT fname,lname,specialty,dateLicensed FROM Doctor WHERE dateLicensed <' ." "."'$beforeDate'";
        //echo $query1;
        echo '<br>';

        $res = mysqli_query($connection,$query1);
        if (!$res) {
        die("databases query failed.");
        }

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
   mysqli_close($connection);
?>
</body>
</html>
