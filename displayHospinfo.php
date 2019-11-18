<?php

        $query1 = 'SELECT uniqueCode,hospitalName,province FROM Hospital';

        $result = mysqli_query($connection,$query1);
        if (!$result) {
        die("databases query failed.");
        }
        echo "<ol>";
        while ($row = mysqli_fetch_assoc($result)) {
         echo "<li>";
         echo $row["uniqueCode"].",----- ".$row["hospitalName"].", ".$row["province"];
        }
        mysqli_free_result($result);
        echo "</ol>";
?>

