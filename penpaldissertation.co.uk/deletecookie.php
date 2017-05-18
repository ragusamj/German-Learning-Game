<?php
session_start();
$servername = "localhost:3306";
$database = "scoutdatabase";
$dbusername = "markwatt";
$dbpassword = "Urn9nm8t";
$table = "progressTrack";



// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $database);



// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
$usernameCookie = $_SESSION["username"];
$updatestagedragwrong ="UPDATE `dragGame` SET `saveStage` = `saveStage` + 1 where `username` ='$usernameCookie'";
$updatestagedrag ="UPDATE `dragGame` SET `saveStage` = `saveStage` + 1, `correctAnswer` = `correctAnswer` + 1 where `username` ='$usernameCookie'";

//Check if cookie is set, cookie only set if draggame answer is correct
if(isset($_COOKIE['Attempts'])){
            setcookie("Attempts", "", time() - 3600);
            setcookie("Attempts", "", time() - 3600, '/');
			
       header("Location: draggame.php");
	   //update the correct answer for drag
	   $conn->query($updatestagedrag);
	   
} else if(!isset($_COOKIE['Attempts'])){
	
	
	 header("Location: draggame.php");
	   
	   $conn->query($updatestagedragwrong);
	 echo "<script type='text/javascript'>alert('Not Correct');</script>";
	
	
	
}else {

	 echo "<script type='text/javascript'>alert('Not Correct');</script>";
}
?>