<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>My Hospital Database</title>
</head>
<body>
<!-- Include the php file to be connected to database -->
<?php
include 'connectdb.php';
?>
<h1 id="title"> My Hospital Databse </h1>
<br>

<!-- under this heading will be any information related to doctor or patient-->

<h2 class = "allh2">Doctor/Patient Information: </h2>
<br>
<h4> Would you like to get all Doctors or Doctors licensed before a given date?</h4>

<!-- On click function in javascript, hides or displays a certain div -->

<button onclick="displayEntry('dateDoc')"> Before Date </button>
<button  onclick="displayEntry('radio')"> Get all doctors </button>
<!-- when this form is submited it will load the 
getdoctors file to get all doctors in database
-->

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

<!-- when this form is submited it will load the
docdate page to display all doctors licensed before the 
provided date
-->

<form class="form" action="docdate.php" method="post">

<div id="dateDoc">

	<h4 class="allh4"> Get all Doctors licensed before: </h4>
	Enter Date: <input type="date" name="dates" required><br>
	<input type="submit" value="Get Doctors">
</div>
</form>

<h4 class = "allh4">Insert or Delete Doctor: </h4>

<button onclick = "displayEntry('newDoc')">Insert Doctor</button>
<button onclick = "displayEntry('deldoc')">Delete Doctor</button>

<div id="newDoc">

<h5>Hopsital Code ,----- Hospital Name,province.</h5>

<?php
	include 'displayHospinfo.php'
?>
<!-- when this form is submitted it will load the newdoc page
hopefully informing the user that a new doctor has been created 
succesfully
-->

	<form class="form" name="form3" action="newdoc.php" method="post">
		
		License Number: <input type="text" name="lnum" required><br>
		FirstName: <input type="text" name="fname" ><br>
		LastName: <input type="text" name="lname" ><br>
		Specialty: <input type="text" name="spec"><br>
		DateLicensed: <input type="date" name="license"><br>
		Hospital Code: <input type="text" name="HospCode" required><br>

		<input type="submit" value"Insert Doctor"> 
	</form>
</div>
<div id="deldoc">

<!-- when this form is submited it will load the
delete doc page hopefully letting the user know that a doctor
was deleted succesfully 
-->
	
	<form class="form" name="form4" action="deletedoc.php" method="post">
        <br>
        Select Doctor:
        <select name="choosedoc">
        <?php
                include 'alldocs.php';
        ?>
        <input type="submit" value"Delete Doctor">
        </select>
        </form>
</div>

<h4 class = "allh4">Get doctors treating a patient: </h4>

<button onclick ="displayEntry('dispForm')"> Insert Patient </button>

<div id="dispForm">

<!-- when this form is submitted it will load the docpatient page
hopefully displaying all doctors treating a specific patient
-->

	<form class="form" name="form5" action="docpatient.php" method="post">
	Patient OHIP: <input type="text" name="patohip" required><br>
	<input type="submit" value="View Info"><br>
        </form>

</div>

<h4 class = "allh4">Assign doctor to patient or stop doctor from treating patient: </h4>

<button onclick ="displayEntry('assign')"> Assign Patient</button>
<button onclick ="displayEntry('stopDoc')"> Stop Treating</button><br>

<div id="assign">
<!-- when this form is submited it will load the treats.php page
hopefully succesfully assigning a doctor to treat a patient
upon user request
-->

	<form class="form" name="form6" action="treats.php" method="post">
        Patient OHIP: <input type="text" name="patohip1" required><br>
	Doctor License Number:
        <select name="docLic">
        <?php
                include 'alldocs.php';
        ?>
        <input type="submit" value"Submit">
        </select>
        </form>

</div>

<div id="stopDoc">
<!-- when this form is submited it will load the stoptreat page
to hopefully stop a doctor from treating a patient upon
user request
-->

	<form class="form" name="form7" action="stoptreat.php" method="post">
        Patient OHIP: <input type="text" name="patohip2" required><br>
       	Doctor License Number:
        <select name="docLic2">
        <?php
                include 'alldocs.php';
        ?>
        <input type="submit" value"Submit">
        </select>
        </form>

</div>
<br>

<h4 class="allh4">Doctors currently not treating any patients: </h4>

<button onclick="displayEntry('nottreating')"> Get Doctors </button><br>

<!-- i included this php tag in index2.php because i dont plan on
reusing it
-->

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

<!-- when button clicked it will dispaly information about 
all hospitals by loading gethospitals php file
-->

<div id="hospDisplay">
<?php
	include 'gethospitals.php';
?>
</div>

<h4 class="allh4">Update Hospital Name: </h4>
<h5>Hopsital Code ,----- Hospital Name,province.</h5>

<!-- show some information about all hospitals
so users know what to enter when updating 
the hospital
-->

<?php
	include 'displayHospinfo.php'
?>
<br>
<!-- when this form is submited it will load the
updatehosp page to hopefully update a hospital
name upon user request
-->

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
