<?php
require "InputValidator.php";
?>


<!DOCTYPE HTML>  
<html>
<head>
<style>

@import url(https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600);

.error {color: #FF0000;}

* {
	margin:0;
	padding:0;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	-webkit-font-smoothing:antialiased;
	-moz-font-smoothing:antialiased;
	-o-font-smoothing:antialiased;
	font-smoothing:antialiased;
	text-rendering:optimizeLegibility;
}

body {
	font-family:"Open Sans", Helvetica, Arial, sans-serif;
	font-weight:300;
	font-size: 12px;
	line-height:30px;
	color:#777;
	background: linear-gradient(90deg,#77A1D3 0%,#79CBCA 50%,#E684AE 100%);
}

.container {
	max-width:400px;
	width:100%;
	margin:0 auto;
	position:relative;
}

#contact input[type="text"], #contact input[type="email"], #contact input[type="tel"], #contact input[type="url"], #contact textarea, #contact button[type="submit"] { font:400 12px/16px "Open Sans", Helvetica, Arial, sans-serif; }

#contact {
	background:#F9F9F9;
	padding:25px;
	margin:50px 0;
}

#contact h3 {
	color: #F96;
	display: block;
	font-size: 30px;
	font-weight: 400;
}

#contact h4 {
	margin:5px 0 15px;
	display:block;
	font-size:13px;
}

fieldset {
	border: medium none !important;
	margin: 0 0 10px;
	min-width: 100%;
	padding: 0;
	width: 100%;
}

#contact input[type="text"], #contact input[type="email"], #contact input[type="tel"], #contact input[type="url"], #contact textarea {
	width:100%;
	border:1px solid #CCC;
	background:#FFF;
	margin:0 0 5px;
	padding:10px;
}

#contact input[type="text"]:hover, #contact input[type="email"]:hover, #contact input[type="tel"]:hover, #contact input[type="url"]:hover, #contact textarea:hover {
	-webkit-transition:border-color 0.3s ease-in-out;
	-moz-transition:border-color 0.3s ease-in-out;
	transition:border-color 0.3s ease-in-out;
	border:1px solid #AAA;
}

#contact textarea {
	height:100px;
	max-width:100%;
  resize:none;
}

#contact button[type="submit"] {
	cursor:pointer;
	width:100%;
	border:none;
	background:#0CF;
	color:#FFF;
	margin:0 0 5px;
	padding:10px;
	font-size:15px;
}

#contact button[type="submit"]:hover {
	background:#09C;
	-webkit-transition:background 0.3s ease-in-out;
	-moz-transition:background 0.3s ease-in-out;
	transition:background-color 0.3s ease-in-out;
}

#contact button[type="submit"]:active { box-shadow:inset 0 1px 3px rgba(0, 0, 0, 0.5); }

#contact input:focus, #contact textarea:focus {
	outline:0;
	border:1px solid #999;
}
::-webkit-input-placeholder {
 color:#888;
}
:-moz-placeholder {
 color:#888;
}
::-moz-placeholder {
 color:#888;
}
:-ms-input-placeholder {
 color:#888;
}

    </style>
</head>
<body>  

<?php
// define variables and set to empty values
$name = $nameErr = $address1 = $address1Err = $address2Err = $address2 = $city = $cityErr = $genderErr = $websiteErr = $state = $stateErr = $zipcode = $zipcodeErr = "";
$inputvalidator =  new InputValidator;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
	$nameErr = $inputvalidator->name_tester($_POST["name"]);
  }
  
  if (empty($_POST["address1"])) {
    $address1Err = "Address 1 is required";
  }
  else{
	$address1Err = $inputvalidator->address_1_tester($_POST["address1"]);
  }

  if (empty($_POST["address2"])) {
    $address2Err = "Address 2 is required";
  }
  else{

	$address2Err = $inputvalidator->address_2_tester($_POST["address2"]);
  }


  if (empty($_POST["city"])) {
    $cityErr = "City is required";
  }
  else{
	$cityErr = $inputvalidator->city_tester($_POST["city"]);
  }

  if (empty($_POST["state"])) {
    $stateErr = "State is required";
  }
  else{
	$state = $inputvalidator->test_input($_POST["state"]);
  }

  if (empty($_POST["zipcode"])) {
    $zipcodeErr = "Zipcode is required";
  }
  else{

	$zipcodeErr = $inputvalidator->zip_code_tester($_POST["zipcode"]);

  }
    
}

?>
<div class="container">
<h2>Profile Page</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<fieldset>
  Full Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
</fieldset>
  <br><br>
  <fieldset>
  Address 1: <input type="text" name="address1" value="<?php echo $address1;?>">
  <span class="error">* <?php echo $address1Err;?></span>
</fieldset>
  <br><br>
  <fieldset>
  Address 2: <input type="text" name="address2" value="<?php echo $address2;?>">
  <!-- <span class="error">* <?php echo $address2Err;?></span> -->
</fieldset>
  <br><br>
  <fieldset>
  City: <input type="text" name="city" value="<?php echo $city;?>">
  <span class="error">* <?php echo $cityErr;?></span>
</fieldset>
  <br><br>
  <fieldset>
  <p>Select State</p>
			<select type="text" id="state">
				<option value="">- -</option>
				<option value="AK">AK</option>
				<option value="AL">AL</option>
				<option value="AR">AR</option>
				<option value="AZ">AZ</option>
				<option value="CA">CA</option>
				<option value="CO">CO</option>
				<option value="CT">CT</option>
				<option value="DC">DC</option>
				<option value="DE">DE</option>
				<option value="FL">FL</option>
				<option value="GA">GA</option>
				<option value="HI">HI</option>
				<option value="IA">IA</option>
				<option value="ID">ID</option>
				<option value="IL">IL</option>
				<option value="IN">IN</option>
				<option value="KS">KS</option>
				<option value="KY">KY</option>
				<option value="LA">LA</option>
				<option value="MA">MA</option>
				<option value="MD">MD</option>
				<option value="ME">ME</option>
				<option value="MI">MI</option>
				<option value="MN">MN</option>
				<option value="MO">MO</option>
				<option value="MS">MS</option>
				<option value="MT">MT</option>
				<option value="NC">NC</option>
				<option value="ND">ND</option>
				<option value="NE">NE</option>
				<option value="NH">NH</option>
				<option value="NJ">NJ</option>
				<option value="NM">NM</option>
				<option value="NV">NV</option>
				<option value="NY">NY</option>
				<option value="OH">OH</option>
				<option value="OK">OK</option>
				<option value="OR">OR</option>
				<option value="PA">PA</option>
				<option value="PR">PR</option>
				<option value="RI">RI</option>
				<option value="SC">SC</option>
				<option value="SD">SD</option>
				<option value="TN">TN</option>
				<option value="TX">TX</option>
				<option value="UT">UT</option>
				<option value="VA">VA</option>
				<option value="VT">VT</option>
				<option value="WA">WA</option>
				<option value="WI">WI</option>
				<option value="WV">WV</option>
				<option value="WY">WY</option>
				</select>
				<span class="error">* <?php echo $stateErr;?></span>
</fieldset>
				<br><br>
				<fieldset>
				<input name = "zipcode" placeholder="Zipcode" type="text" pattern = "[0-9]*" tabindex="3">
				<span class="error">* <?php echo $zipcodeErr;?></span>
</fieldset>
				<br><br>

  <input type="submit" name="submit" value="Submit">  
</form>
</div>
</body>
</html>
