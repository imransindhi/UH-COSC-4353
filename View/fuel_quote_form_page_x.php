<?php
require "InputValidator.php";
?>

<html>
<head>
    <style>

@import url(https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600);


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

.error {color: #FF0000;}


    </style>

</head>

<body>



<?php
ini_set('display_errors',0); 
// define variables and set to empty values
session_start();
$gallons = $gallonsErr = $address1 = $address1Err = $address2Err = $address2 = $city = $cityErr = $genderErr = $websiteErr = $state = $stateErr = $zipcode = $zipcodeErr = "";
$inputvalidator =  new InputValidator;
$total = 0;
$suggestedprice = 0;
$gallons = (int)$gallons;

$user_id = $_SESSION['user_id'];

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   if (empty($gallons)) {
//     $gallonsErr = "Number of gallons is required";
//   } else {
//     $numberOfgallons = test_input($gallons);
// 	if (strlen($numberOfgallons) < 1)
// 	{
// 		$gallonsErr = "Please enter a valid amount!";
// 	}
//   }
    
// }

if(isset($_POST['get_quote'])) {
	$gallons = $_REQUEST['gallons'];
    $date = $_REQUEST['date'];
	$current_price = 1.50;
	$state = $inputvalidator->getUserState($user_id);
	$history = $inputvalidator->getUserHistory($user_id);
	if ($state == "TX")
	{
		$location_factor = 0.02;
	}
	else
	{
		$location_factor = 0.04;
	}

	if ($history == "")
	{
		$ratehistoryfactor = 0.0;
	}
	else{
		$ratehistoryfactor = 0.01;
	}

	if ($gallons == "")
	{
		$current_price = 0;
	}
	if ($gallons > 1000)
	{
		$Gallonsrequestedfactor = 0.02;
	}
	else{
		$Gallonsrequestedfactor = 0.03;
	}

	$companyprofitfactor = 0.10;

	$margin = ($location_factor - $ratehistoryfactor + $Gallonsrequestedfactor + $companyprofitfactor) * $current_price;

	$suggestedprice = $current_price + $margin;
	$total = $gallons * $suggestedprice;
	$_SESSION['suggested_price'] = $suggestedprice;
	$_SESSION['total_price'] = $total;
	$_SESSION['user_address'] = $inputvalidator->getUserAddress($user_id);
}

if(isset($_POST['submit'])) {
	$gallons = $_REQUEST['gallons'];
	$date = $_REQUEST['date'];
	$current_price = 1.50;
	$state = $inputvalidator->getUserState($user_id);
	$history = $inputvalidator->getUserHistory($user_id);
	if ($state == "TX")
	{
		$location_factor = 0.02;
	}
	else
	{
		$location_factor = 0.04;
	}

	if ($history == "")
	{
		$ratehistoryfactor = 0.0;
	}
	else{
		$ratehistoryfactor = 0.01;
	}

	if ($gallons == "")
	{
		$current_price = 0;
	}
	if ($gallons > 1000)
	{
		$Gallonsrequestedfactor = 0.02;
	}
	else{
		$Gallonsrequestedfactor = 0.03;
	}

	$companyprofitfactor = 0.10;

	$margin = ($location_factor - $ratehistoryfactor + $Gallonsrequestedfactor + $companyprofitfactor) * $current_price;
	$suggestedprice = $current_price + $margin;
	$total = $gallons * $suggestedprice;
	$_SESSION['suggested_price'] = $suggestedprice;
	$_SESSION['total_price'] = $total;
	$_SESSION['user_address'] = $inputvalidator->getUserAddress($user_id);


	$db = new SQLite3('my_database.db');
	$SQLStatement = "INSERT INTO FuelQuote (USER_ID, GALLONS_REQUESTED, DELIVERY_DATE, TOTAL_PRICE) VALUES ('$_SESSION[user_id]','$gallons', '$date', '$_SESSION[total_price]')";
	echo $SQLStatement;
	$result = $db->query($SQLStatement);
	$db->close();

	header("Location: /fuel_quote_history_x.php");
    exit;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>




    <div class="container">  
        <form id="contact" action="" method="post">
          <h3>Fuel Quote Form</h3>
          <h4>Enter fuel requirement</h4>
            <input name = "gallons" id = "gallons" placeholder="Gallons Requested" type="text" pattern = "[0-9]*" tabindex="1" autofocus value = "<?php echo $gallons; ?>">
		  <span class="error">* <?php echo "This is required";?></span>
		  <br><br>
          <fieldset>
		  <h4>Delivery Address</h4>
			<b><p style="color:#000; font-size:120%;"><?php echo $inputvalidator->getUserAddress($user_id); ?></p></b>
          </fieldset>
          <fieldset>
			  <h4>Delivery Date</h4>
            <input name = "date" placeholder="Date" type="date" tabindex="1" required value = "<?php echo $date; ?>">
          </fieldset>

          <fieldset>
			<b><p style="color:#000; font-size:150%;"><?php echo "Suggested Price is : $ " . $suggestedprice; ?></p></b>
          </fieldset>

		  <fieldset>
			<b><p style="color:#000; font-size:150%;"><?php echo "Total Amount Due is : $ " . $total; ?></p></b>
          </fieldset>
		  <fieldset>
            <button name="get_quote" type="submit" id="get_quote" data-submit="...Sending" formaction = "fuel_quote_form_page_x.php">Get Quote</button>

          </fieldset>
          <fieldset>
            <button name="submit" type="submit">Submit</button>

          </fieldset>
        </form>
       
        
      </div>

</body>
</html>
