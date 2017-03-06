<?php
	session_start();

$servername = "localhost:3306";
$database = "scoutdatabase";
$dbusername = "markwatt";
$dbpassword = "Urn9nm8t";
$table = "penpalstore";
	//$usernameCookie = $_SESSION["username"];
//$verificationCodeCookie = $_SESSION["verification_code"];
	// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $database);
// check first if record exists
//$query = "SELECT id FROM users WHERE verification_code = ? and status = 'inactive'";
//$stmt = $conn->prepare( $query );
$code = $_GET['code'];
//$stmt->bindParam(1, $_GET['code']);
//$stmt->close();
//$stmt->execute();
//$num = $stmt->rowCount();
$results = mysql_query("SELECT `id` FROM penpalstore WHERE `verification_code` ='$code'");  
$updatestatus = "UPDATE penpalstore SET status='active' WHERE `verification_code`= '$code' ";
//if ($conn->connect_error) {
//die("Connection failed: " . $conn->connect_error);
//} 
//else{
  

 $conn->query($results);
  $conn->query($updatestatus);
    
//}
 //else {
 echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/index.html>";
 //}
?>


		