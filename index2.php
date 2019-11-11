
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>My Hospital Database</title>
</head>
<body>
<?php
include 'connectdb.php';
?>
<h1 id="title"> My Hospital Databse </h1>
<br>
<h2 class = "allh2">Doctor/Patient Information: </h2>
<br>
<h4> Would you like to get all Doctors or Doctors licensed before a given date?</h4>
<button onclick="displayEntry('dateDoc')"> Before Date </button>
<button  onclick="displayEntry('radio')"> Get all doctors </button>
<form class ="form" action = "getdoctors.php" method="post">
<div id = "radio">
	<h4 class ="allh4"> Order by</h4>
	<input class = "" onclick = "displayEntry('last')" type="radio" name="order" value="fname">FirstName<br>
	<input class = "" onclick = "displayEntry('last')" type="radio" name="order" value="lname">LastName<br>
	<div id ="last">
		<h4 class ="allh4"> Ascending or Descending</h4>
		<input  type="radio" name="ascordsc" value="asc">Ascending<br>
	        <input  type="radio" name="ascordsc" value="desc">Descending<br>
		<input id ="sub1" type="submit" value="Get Data">
	</div>
</div>
</form>
<form class="form" action="docdate.php" method="post">
<div id="dateDoc">
	<h3 class="allh3"> Get all Doctors licensed before: </h3><br>
	Enter Date: <input type="date" name="dates" required><br>
	<input type="submit" value="Get Doctors">
</div>
</form>
<h4 class = "allh4">Insert or Delete Doctor: </h4>
<button onclick = "displayEntry('newDoc')">Insert Doctor</button>
<button onclick = "displayEntry('deldoc')">Delete Doctor</button>

<div id="newDoc">
	<form class="form" name="form3" action="newdoc.php" method="post">
		
		License Number: <input type="text" name="lnum" required><br>
		FirstName: <input type="text" name="fname" value=NULL><br>
		LastName: <input type="text" name="lname" value = NULL><br>
		Specialty: <input type="text" name="spec"value=NULL><br>
		DateLicensed: <input type="date" name="license"><br>
		Hospital Code: <input type="text" name="hospcode" required><br>

		<input type="submit" value"Insert Doctor"> 
	</form>
</div>
<div id="deldoc">
	<form class="form" name="form4" action="" method="post">
	FirstName: <input type="text" name="fname" required><br>
        LastName: <input type="text" name="lname" required><br>
	<input type="submit" value"Delete Doctor">
	</form>
</div>
<h4 class = "allh4">Get doctor treating a patient: </h4>
<button onclick ="displayEntry('dispForm')"> Insert Patient </button>
<div id="dispForm">

	<form class="form" name="form5" action="" method="post">
	Patient OHIP: <input type="text" name="patohip" required><br>
	<input type="submit" value="View Info"><br>
        </form>

</div>
<h4 class = "allh4">Assign doctor to patient or stop doctor from treating patient: </h4>
<button onclick ="displayEntry('assign')"> Assign Patient</button>
<button onclick ="displayEntry('stopDoc')"> Stop Treating</button><br>
<div id="assign">
	<form class="form" name="form6" action="" method="post">
        Patient OHIP: <input type="text" name="patohip1" required><br>
	Doctor License Number: <input type="text" name="docLic" required><br>
        <input type="submit" value="Submit"><br>
        </form>

</div>
<div id="stopDoc">
	<form class="form" name="form7" action="" method="post">
        Patient OHIP: <input type="text" name="patohip2" required><br>
        Doctor License Number: <input type="text" name="docLic2" required><br>
        <input type="submit" value="Submit"><br>
        </form>

</div>
<br>
<h4 class="allh4">Doctors currently not treating any patients: </h4>
<button onclick="displayEntry('nottreating')"> Get Doctors </button><br>
<div id="nottreating">
	<?php
		$query1= 'SELECT fname,lname FROM Doctor WHERE licenseNumber NOT IN(SELECT licenseNumber FROM Treats)';
		$result = mysqli_query($connection,$query1);

		if (!$result) {
     			die("databases query failed.");
		}
		$length = 0;
		echo "<ol>";
		while ($row = mysqli_fetch_assoc($result)) {
		$length++;
		if($length = 0)
		{
			echo 'All doctors are currently treating a patient';
		}

    		echo "<li>";
    		echo $row["fname"].", ".$row["lname"]. "</li>";
		
		}
		mysqli_free_result($result);
		
		echo "</ol>"

	?>
</div>

<h2 clas="allh2">Hospital Info: <h2>
<button onclick= "displayEntry('hospDisplay')"> View Hospitals</button>
<div id="hospDisplay">
<?php
	include 'gethospitals.php';
?>
</div>
<h4 class="allh4">Update Hospital Name: </h4>
<h5>Hopsital Code ,----- Hospital Name,province.</h5>
<?php

	$query1 = 'SELECT uniqueCode,hospitalName,province FROM Hospital';

	$result = mysqli_query($connection,$query1);
	if (!$result) {
     	die("databases query failed.");
	}
	echo "<ol>";
	while ($row = mysqli_fetch_assoc($result)) {
    	 echo "<li>";
   	 echo $row["uniqueCode"].",----- ".$row["hospitalName"].", ".$row["province"]."</li>";
	}
	mysqli_free_result($result);
	echo "</ol>";
?>
<br>
<form class="form" name="form8" action="updatehosp.php" method="post">
	Hospital Code: <input type="text" name="hospcode" required><br>
	New Hospital Name: <input type="text" name="newname" required><br>

	<input type="submit" value"Update Name">
<?php
   mysqli_close($connection);
?>

<script src="script.js"></script>
</body> 
</html>
