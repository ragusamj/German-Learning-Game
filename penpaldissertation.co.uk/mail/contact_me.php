
<!DOCTYPE html>

<?php include
session_start();
$servername = "localhost:3306";
$database = "scoutdatabase";
$dbusername = "markwatt";
$dbpassword = "Urn9nm8t";
$table = "penpalstore";


// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$usernameCookie = $_SESSION["username"];
$setupPenpal ="SELECT `penpalID` FROM penpalstore where `username` = '$usernameCookie'";
$PID = $_SESSION["PID"]; 
$errors = '';

$response = $conn->query($setupPenpal);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$PID = $result["penpalID"];
		$_SESSION["PID"] = $PID;
	}
}

	//send your penpal a message
if(isset($usernameCookie) && !isset($_POST['q1']))
{
$myemail = 'Newmessage@penpal.co.uk';
$email_address = $_SESSION['PID'];
$message = $_POST['message'];
	
	
$to = $email_address;
   $email_subject = "Contact form submission: $PID";
    $email_body = "You have received a new message/Sie haben eine neue Nachricht erhalten. ".
        " Here are the details/Hier sind die details:\n Account: $usernameCookie \n ".
        "\n Message: \n $message";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
   
 
   echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/home.php\">";
   
}else {
    echo $errors;
}

//send passcode reset combo
if(!isset($usernameCookie)){
	
	$input= array("1", "2", "3", "4","5", "6");
    shuffle ($input );

$passcode = $input[0].$input[1].$input[2].$input[3].$input[4].$input[5];
 $_SESSION['passcode'] = $passcode;
 
$myemail = 'passwordchange@penpal.co.uk';
$email_address = $_POST['reminder'];	
$to = $email_address;
   $email_subject = "Contact form submission";
    $email_body = "You have received a new message/Sie haben eine neue Nachricht erhalten. ".
        " Head back to the new password page/Komm zuruck zur neuen Passwort-Seite,\n". 
        "\n Message: REMEMBER THIS PASSCODE /Erinnere dich an diesen passcode >>>>> \n". $passcode;
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
   
   $_SESSION['usernameTemp'] = $email_address;	
   $_SESSION['passcode'] = $passcode;
//echo $passcode; 
    //echo "<script type='text/javascript'>alert('Wrong next level');</script>";
   echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/newpassword.php\">";
	
	
	
	
	
	
}
//send penpal test questions
if (isset($_POST['q1']) && isset($_SESSION["PID"])){
	
	
$myemail = 'Newmessage@penpal.co.uk';
$email_address = $_SESSION['PID'];
$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];	
	
$to = $email_address;
   $email_subject = "Contact form submission: $PID";
    $email_body = "You have received a new set of questions from your PenPal!/Sie haben neue Fragen erhalten. ".
        " Email your responces back to $PID as soon as possible/Mailen Sie Ihre Antworten zurück \n ".
        "\n Question 1: \n $q1".
		 "\n Question 2: \n $q2".
		  "\n Question 3: \n $q3".
		   "\n Questions 4: \n $q4";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
   
 
   echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/home.php\">";
   
}
	
	
	
	

	



 ?>
  
