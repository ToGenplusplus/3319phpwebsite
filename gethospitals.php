<?php
//get all hospitals and information about hospital including head doctors
$query = 'SELECT hospitalName,fname,lname,dateHead FROM Hospital,Doctor WHERE headDoctor =licenseNumber ORDER BY hospitalName';

$result = mysqli_query($connection,$query);
if (!$result) {
     die("databases query failed.");
}

echo "<ol>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li>";
    echo $row["hospitalName"] .", ".$row["fname"] .", ".$row["lname"] .", ".$row["dateHead"]."</li>";
}

mysqli_free_result($result);
echo "</ol>";
?>
