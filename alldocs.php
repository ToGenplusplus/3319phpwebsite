<?php
$query = "SELECT * FROM Doctor";	//get all information from doctor table
$result = mysqli_query($connection,$query);
if (!$result) {	// if query fails
     die("databases query failed.");
}

//if query didn't fial
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value ='.$row["licenseNumber"].'>';
    echo $row["licenseNumber"] .", ". $row["fname"] . ", ".$row["lname"] .".";
    echo '</option>';
}

mysqli_free_result($result);	//free result after done using.


?>
