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
	$hosp = strtoupper($_POST["hospcode"]);		//get hospital code from user
        $newname = $_POST["newname"];		// get new hospital name from user

	$query1 = 'SELECT * FROM Hospital WHERE uniqueCode = '. "'$hosp'" ;
	$res = mysqli_query($connection,$query1);

	if(!$res)
	{
		die("databases query failed.".mysqli_error($connection));
	}

	$len = 0;

	while($row = mysqli_fetch_assoc($res))
	{
		$len++;
		mysqli_free_result($res);
	}

	if($len == 0)
	{

		echo 'Input valid hospital code ';
	}
	else{

		//query updates hospital name to user specified new name
        	$query = 'UPDATE Hospital SET hospitalName ='."'$newname'".' WHERE uniqueCode ='."'$hosp'";
        	$result = mysqli_query($connection,$query);

        	if (!$result) {
           		die("databases query failed.");
			mysqli_free_result($result);
        	}

		echo ' ';
		echo '<br>';
        	echo 'Hospitals Name has been updated to:  ' .$newname;
        }
       
?>
<?php
mysqli_close($connection);	//always close connection after done using
?>
</body>
</html>
