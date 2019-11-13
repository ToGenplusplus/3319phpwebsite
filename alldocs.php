<?php
$query = "SELECT * FROM Doctor";
$result = mysqli_query($connection,$query);
if (!$result) {
     die("databases query failed.");
}


while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value ='.$row["licenseNumber"].'>';
    echo $row["licenseNumber"] .", ". $row["fname"] . ", ".$row["lname"] .".";
    echo '</option>';
}

mysqli_free_result($result);


?>
