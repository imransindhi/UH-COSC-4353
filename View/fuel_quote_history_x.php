<html>
<head>
</head>
<body>
<center>
<h1>FUEL QUOTE HISTORY</h1>
<table border = "1" width=100%>
<tr>
<td style="padding: 20px;"><center><b><h2>GALLONS REQUESTED</h2><b></center></td>
<td><center><b><h2>DELIVERY DATE</h2><b></center></td>
<td><center><b><h2>DELIVERY ADDRESS</h2><b></center></td>
<td><center><b><h2>TOTAL PRICE</h2><b></center></td>
</tr>
<?php
ini_set('display_errors',0); 
require "InputValidator.php";
session_start();
$db = new SQLite3('my_database.db');
$SQLStatement = "SELECT * FROM FuelQuote WHERE USER_ID=" . "'$_SESSION[user_id]'";
$result = $db->query($SQLStatement);

while($row = $result->fetchArray())
{
    echo "<tr><td style=" . "'padding: 10px;'". ">$row[1]</td><td>$row[2]</td><td>$_SESSION[user_address]</td><td>$" . "$row[3]</td></tr>";
}

$db->close();?>


</table>
<br><br>
<div style = "width: 100%;margin: 0 auto;flex-direction: row;justify-content: center;">
<div>
<a href = '/fuel_quote_form_page_x.php'>Get A New Quote</a>
</div>
<div>
<a href = '/login_page.php'>Logout</a>
</div>
</div>
</center>
</body>
</html>
