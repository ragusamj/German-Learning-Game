<?php

session_start();

$servername = "localhost:3306";
$database = "scoutdatabase";
$dbusername = "markwatt";
$dbpassword = "Urn9nm8t";
$table = "penpalstore";

//login variables
$username = $_POST['username'];
$password = $_POST['pwd'];
$hash = crypt($password, base64_encode($password));
$verificationCode = md5(uniqid("yourrandomstringyouwanttoaddhere", true));
$nativeLang = $_POST['nativeL'];


//register variables (+ login vars)
$confirmpwd = $_POST['confirmpwd'];

//update password variables
$oldpwd = $_POST['oldpwd'];
$oldpwdH = crypt($oldpwd, base64_encode($oldpwd));
$newpwd = $_POST['newpwd'];
$newhash = crypt($newpwd, base64_encode($newpwd));
$confirmnewpwd = $_POST['newconfirmpwd'];
$passwordResetFlag = $_POST['passwordResetFlag'];

$English = "English";
$German = "German";
$usernameCookie = $_SESSION["username"];
setcookie("verificationCode", $verificationCode);


// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

//Database interactions
$authQuery = "SELECT id, username, status, nativeLang, Reported FROM penpalstore where `username` = '$username' AND `password` = '$hash'";
$checkforusernameQuery = "SELECT username FROM penpalstore where `username` = '$username'";
$addUserQuery = "INSERT INTO penpalstore (`username`, `password`, `verification_code`,`nativeLang`) VALUES ('$username', '$hash', '$verificationCode', '$nativeLang' )";
$getOldPasswordQuery = "SELECT password FROM penpalstore where `username` = '$usernameCookie'";
$updatePasswordQuery = "UPDATE penpalstore SET password='$newhash' WHERE `username`='$usernameCookie'";
$updatetimeStampQuery = "INSERT INTO timeStamp (`username`) VALUES ('$username')";


if(!$confirmnewpwd){
//If auth doesnt recieve a confirm password post with posted data, it is a log in request
	if(!$confirmpwd){
		$response = $conn->query($authQuery);
		
	}
//Register Request
	else {
		$userExists = $conn->query($checkforusernameQuery);
		if($userExists->num_rows > 0){
			die('user already exists');
		}
		else {
		//adds new user to db
			$conn->query($addUserQuery);
		
		//attempts log in
		$errors = '';
$myemail = 'support@penpal.co.uk';
if(empty($_POST['username'])  ||
   empty($_POST['pwd']) ||
   empty($_POST['confirmpwd']))
  //Native Langauge will be English by Default if not changed
{
    $errors .= "\n Error: all fields are required";
}
$name = $_POST['name'];
$email_address = $_POST['username'];
$message = $_POST['message'];

if( empty($errors))
{//Email the activation email to the posted username
$verificationLink = "http://www.penpaldissertation.co.uk/activate.php?code=" . $verificationCode;
	$to = $email_address;
    $email_subject = "Activation email: $name";
    $email_body = "Please follow this link in order to activate: <a href='{$verificationLink}'\n".
                 " Please then login with your new account details! \n ".
        "Email: $email_address";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    //redirect to the 'thank you' page
    header('Location: youneedtoactivate.php');
}
else {
    echo $errors;
}
		
		}
	
	}
	 
//check constraints to allow login.
if ($response->num_rows > 0){
		if($result = $response->fetch_assoc()){
		
			$userid = $result["id"];
			$username = $result["username"];
            $statusactive = $result["status"];
			$langcheck = $result["nativeLang"];
		    $isReported = $result[ "Reported"];
		//1. check if user is reported
		if($isReported !== "1"){
		
			//2. check if user is active & english
			if ($statusactive === "active" && $langcheck === "English" ){
				
		
	     	$conn->query($updatetimeStampQuery);	
			$_SESSION["username"] = $username;
		    echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/home.php\">";
		
	}
			//3. check if user is active & german
			
		else if($statusactive === "active" && $langcheck === "German" ){
			
		$conn->query($updatetimeStampQuery);
			setcookie("nativeLang", $German, time() + (86400 * 30), "/");
			$_SESSION["username"] = $username;
            echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/home.php\">";
			
		}
		//Other wise if they are reported, notify them
		}else if ($isReported === "1"){
			
			 echo "<script type='text/javascript'>alert('You have been flagged as innaproptiate, contact a member of our team')</script>";
			 	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/index.php\">";
		}
			//Display error for non active account
else{
		
			echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/index.php\">";
			
 echo "<script type='text/javascript'>alert('You need to activate your account')</script>";

		}
		}
		}
	

	
//if log in fails, direct back to log in screen and dislay error
	else if(empty($_SESSION['username']))  {
echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/login.php\">";

	 echo "<script type='text/javascript'>alert('Incorrect Username or Password')</script>";

	}
}

// IF ITS A PASSWORD RESET REQUEST
else {
	$response = $conn->query($getOldPasswordQuery);
	if ($response->num_rows > 0){
		if($result = $response->fetch_assoc()){
			//Old password Matches
			if($oldpwdH === $result["password"]){
				$conn->query($updatePasswordQuery);
			
$errors = '';
$myemail = 'support@penpaldissertation.co.uk';
if(empty($_POST['oldpwd'])  ||
   empty($_POST['newpwd']) ||
   empty($_POST['newconfirmpwd']))
{
    $errors .= "\n Error: all fields are required";
}
$name = $_POST['name'];
$email_address = $_SESSION["username"];
$message = $_POST['message'];

if( empty($errors))
{ //Email that password has been changed
    $actual_link = "http://$_SERVER[HTTP_HOST]"."firsttimelogin.php?id=" . $_SESSION["username"];
	$to = $email_address;
    $email_subject = "Password change notification: $name";
    $email_body = "Your PenPal password has just been changed, If this was not you please contact our support team immediately";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/login.php\">";
}
else {
    echo $errors;
}
			}
			//If Old password doesn't match
			else{
				
				echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/newpassword.php\">";
				//error message 
           echo "<script type='text/javascript'>alert('Incorrect Password combination')</script>";
;			}
		}
	}
}

?>







