<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Hospital</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<?php
	$hosp = $_POST["hospcode"];
        $newname = $_POST["newname"];

        $query = 'UPDATE Hospital SET hospitalName ='."'$newname'".' WHERE uniqueCode ='."'$hosp'";
        $result = mysqli_query($connection,$query);
        if (!$result) {
            die("databases query failed.");
        }
        else
        {
                echo 'Hospitals Name has been updated to:  ' .$newname;
        }
        mysqli_free_result($result);
?>
<?php
mysqli_close($connection);
?>
</body>
</html>
