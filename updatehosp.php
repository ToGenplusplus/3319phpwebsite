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
	$hosp = $_POST["hospcode"];		//get hospital code from user
        $newname = $_POST["newname"];		// get new hospital name from user

		//query updates hospital name to user specified new name
        $query = 'UPDATE Hospital SET hospitalName ='."'$newname'".' WHERE uniqueCode ='."'$hosp'";
        $result = mysqli_query($connection,$query);

        if (!$result) {
            die("databases query failed.");
        }
       
        echo 'Hospitals Name has been updated to:  ' .$newname;
        
        mysqli_free_result($result);
?>
<?php
mysqli_close($connection);	//always close connection after done using
?>
</body>
</html>
