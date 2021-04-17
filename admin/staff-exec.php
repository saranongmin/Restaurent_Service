<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('connection/config.php');
	
	//Connect to mysqli server
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
	if(!$conn) {
		die('Failed to connect to server: ' . mysqli_error());
	}
	
	
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
global $conn;
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($conn,$str);
	}
	
	//Sanitize the POST values
	$FirstName = clean($_POST['fName']);
	$LastName = clean($_POST['lName']);
	$StreetAddress = clean($_POST['sAddress']);
	$MobileNo = clean($_POST['mobile']);
	

	//Create INSERT query
	$qry = "INSERT INTO staff(firstname,lastname,Street_Address,Mobile_Tel) VALUES('$FirstName','$LastName','$StreetAddress','$MobileNo')";
	$result = @mysqli_query($conn,$qry);
	
	//Check whether the query was successful or not
	if($result) {
		echo "<html><script language='JavaScript'>alert('Staff information added successifully.')</script></html>";
		exit();
	}else {
		die("Adding staff information failed ... " . mysqli_error());
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Messages</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Staff Management </h1>
<a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php">Options</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<form id="staffForm" name="staffForm" method="post" action="staff-exec.php" onsubmit="return staffValidate(this)">
  <table width="540" border="0" cellpadding="2" cellspacing="0" align="center">
  <CAPTION><h3>SEND A MESSAGE</h3></CAPTION>
    <tr>
      <th width="200">first name</th>
      <td width="168"><input type="text" name="firstname" id="firstname" class="textfield" /></td>
    </tr>
    <tr>
      <th width="200">Last name</th>
      <td width="168"><input type="text" name="lastname" id="lastname" class="textfield" /></td>
    </tr>
    <tr>
      <th width="200">Street Address</th>
      <td width="168"><input type="text" name="Street_Address" id="Street_Address" class="textfield" /></td>
    </tr>
    <tr>
      <th width="200">Mobile No</th>
      <td width="168"><input type="text" name="Mobile_Tel" id="Mobile_Tel" class="textfield" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><input type="submit" name="Submit" value="Send Message" />
	  <input type="reset" name="Reset" value="Clear Field" /></td>
    </tr>
  </table>
</form>
<hr>
<table border="0" width="1000" align="center">
<CAPTION><h3>SENT MESSAGES</h3></CAPTION>
<tr>
<th>Message ID</th>
<th>Date Sent</th>
<th>Time Sent</th>
<th>Message Subject</th>
<th>Message Text</th>
<th>Action(s)</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['StaffID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['Street_Address']."</td>";
echo "<td>" . $row['Mobile_Tel']."</td>";


echo "</tr>";
}
mysqli_free_result($result);
mysqli_close($conn);
?>
</table>
<hr>
</div>
<?php
  include 'footer.php';
?>
</div>
</body>
</html>