<!DOCTYPE html>
<?php
	session_start();

$servername = "localhost:3306";
$database = "scoutdatabase";
$dbusername = "markwatt";
$dbpassword = "Urn9nm8t";
$table = "penpalstore";

$conn = new mysqli($servername, $dbusername, $dbpassword, $database);

$usernameCookie = $_SESSION['username'];
$code = $_GET['code'];
$results = mysql_query("SELECT `id` FROM penpalstore WHERE `verification_code` ='$code'");  
$updatestatus = "UPDATE penpalstore SET status='active' WHERE `verification_code`= '$code' ";


 

$conn->query($results);
$conn->query($updatestatus);
 
echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/index.php\">";
?>

<html lang="en">
<head>
<title>Activation Process</title>
</head>
<body>

</body>
</html>
		