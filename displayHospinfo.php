<?php

        $query1 = 'SELECT uniqueCode,hospitalName,province FROM Hospital';	//query to get hospital info from hospital table

        $result = mysqli_query($connection,$query1);
        if (!$result) {	//if query fails
        die("databases query failed.");
        }
	//query successful?
        echo "<ol>";
        while ($row = mysqli_fetch_assoc($result)) {
         echo "<li>";
         echo $row["uniqueCode"].",----- ".$row["hospitalName"].", ".$row["province"];	//let the user know which hospital are available
        }
        mysqli_free_result($result);
        echo "</ol>";
?>

