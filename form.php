









<!DOCTYPE HTML>  
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>  

<?php
// define variables and set to empty values
$genderMErr = $genderWErr = $glassesErr = $hatErr = $beardErr = $baldErr = $darkHairErr ="";
$genderM = $genderW = $glasses = $hat = $beard = $bald = $darkHair = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

  if (empty($_POST["genderM"])) {
    $genderMErr = "Answer is required";
  } else {
    $genderM = test_input($_POST["genderM"]);
  }
  if (empty($_POST["genderW"])) {
    $genderWErr = "Answer is required";
  } else {
    $genderW = test_input($_POST["genderW"]);
  }
  if (empty($_POST["glasses"])) {
    $glassesErr = "Answer is required";
  } else {
    $glasses = test_input($_POST["glasses"]);
  }
   if (empty($_POST["hat"])) {
    $hatErr = "Answer is required";
  } else {
    $hat = test_input($_POST["hat"]);
  }
   if (empty($_POST["beard"])) {
    $beardErr = "Answer is required";
  } else {
    $beard = test_input($_POST["beard"]);
  }
   if (empty($_POST["bald"])) {
    $baldErr = "Answer is required";
  } else {
    $bald = test_input($_POST["bald"]);
  }
  if (empty($_POST["darkHair"])) {
    $darkHairErr = "Answer is required";
  } else {
    $darkHair = test_input($_POST["darkHair"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="container">

  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading"><h2>FORM</h2></div>
      <div class="panel-body">
	<div class="panel-group">  
 <div class="form-group row " class="center">
  <div class="col-sm-2">Is he a man?</div>
	  <div class="col-sm-10">
	  	<input class="form-check-input" type="checkbox" id="gridCheck1"  name="genderM" <?php if (isset($genderM) && $genderM=="Yes") echo "checked";?> value="Yes">Yes
	    <input class="form-check-input" type="checkbox" id="gridCheck1"  name="genderM" <?php if (isset($genderM) && $genderM=="No") echo "checked";?> value="No">No
      </div>
	  <br><br>
	<div class="col-sm-2">Is she a waman?</div> 
	<div class="col-sm-10">
	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="genderW" <?php if (isset($genderW) && $genderW=="Yes") echo "checked";?> value="Yes">Yes
	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="genderW" <?php if (isset($genderW) && $genderW=="No") echo "checked";?> value="No">No
	</div>

	  <br><br>
	  <div class="col-sm-2">Dose he/she wear glasses?</div>
     <div class="col-sm-10">
	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="glasses" <?php if (isset($glasses) && $glasses=="Yes") echo "checked";?> value="Yes">Yes
	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="glasses" <?php if (isset($glasses) && $glasses=="No") echo "checked";?> value="No">No</div>
	
	  <br><br>
	   <div class="col-sm-2">Dose he/she wear hat?</div><div class="col-sm-10">

	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="hat" <?php if (isset($hat) && $hat=="Yes") echo "checked";?> value="Yes">Yes
	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="hat" <?php if (isset($hat) && $hat=="No") echo "checked";?> value="No">No
	</div>
	   <br><br>
	  <div class="col-sm-2">Dose he/she have a beard?</div><div class="col-sm-10">
 
	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="beard" <?php if (isset($beard) && $beard=="Yes") echo "checked";?> value="Yes">Yes
	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="beard" <?php if (isset($beard) && $beard=="No") echo "checked";?> value="No">No
	</div>
	  
	  <br><br>
	   <div class="col-sm-2">Dose he/she bald?</div><div class="col-sm-10">

	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="bald" <?php if (isset($bald) && $bald=="Yes") echo "checked";?> value="Yes">Yes
	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="bald" <?php if (isset($bald) && $bald=="No") echo "checked";?> value="No">No
	</div>
	
	  <br><br>
	   <div class="col-sm-2">Dose he/she dark hair?</div>
	   <div class="col-sm-10">

	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="darkHair" <?php if (isset($darkHair) && $darkHair=="Yes") echo "checked";?> value="Yes">Yes
	  <input class="form-check-input" type="checkbox" id="gridCheck1"  name="darkHair" <?php if (isset($darkHair) && $darkHair=="No") echo "checked";?> value="No">No
	</div>
	
	  <br><br>
	   <div class="col-sm-2"><input class="btn btn-primary" type="submit" name="submit" value="Submit"> </div> 
 </div>
 </div>
   
 </div>
</div>
</form>


<?php
echo "<h2>Your Input:</h2>";

echo $genderM;
echo "<br>";
echo $genderW;
echo "<br>";
echo $glasses;
echo "<br>";
echo $hat;
echo "<br>";
echo $beard;
echo "<br>";
echo $bald;
echo "<br>";
echo $darkHair;
?>

</body>
</html>
