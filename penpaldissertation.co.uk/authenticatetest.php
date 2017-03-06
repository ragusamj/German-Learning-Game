<?php

session_start();

$servername = "localhost:3306";
$database = "scoutdatabase";
$dbusername = "markwatt";
$dbpassword = "Urn9nm8t";
$table = "penpalstore";

//login vars
$username = $_POST['username'];
$password = $_POST['pwd'];
$hash = crypt($password, base64_encode($password));
$verificationCode = md5(uniqid("yourrandomstringyouwanttoaddhere", true));
//$salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
//$salt = base64_encode($salt);
//$salt = str_replace('+', '.', $salt);
//$hash = crypt($password, '$2y$10$'.$salt.'$');


//register var (+ login vars)
$confirmpwd = $_POST['confirmpwd'];//$confirmpwd2 = crypt($confirmpwd, base64_encode($confirmpwd));
//update password vars
$oldpwd = $_POST['oldpwd'];
$oldpwdH = crypt($oldpwd, base64_encode($oldpwd));

$newpwd = $_POST['newpwd'];
$newhash = crypt($newpwd, base64_encode($newpwd));


$confirmnewpwd = $_POST['newconfirmpwd'];//$confirmnewpwd == crypt($confirmnewpwd, base64_encode($confirmnewpwd));
$passwordResetFlag = $_POST['passwordResetFlag'];
$usernameCookie = $_SESSION["username"];
setcookie("verificationCode", $verificationCode);

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

//Self explanatory Queries
$authQuery = "SELECT id, username, status FROM penpalstore where `username` = '$username' AND `password` = '$hash'";
$checkforusernameQuery = "SELECT username FROM penpalstore where `username` = '$username'";
$addUserQuery = "INSERT INTO penpalstore (`username`, `password`, `verification_code`) VALUES ('$username', '$hash', '$verificationCode' )";
$getOldPasswordQuery = "SELECT password FROM penpalstore where `username` = '$usernameCookie'";
$updatePasswordQuery = "UPDATE penpalstore SET password='$newhash' WHERE `username`='$usernameCookie'";

if(!$confirmnewpwd){
//If page isn't passed a confirm password it is a log in request
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
{
    $errors .= "\n Error: all fields are required";
}
$name = $_POST['name'];
$email_address = $_POST['username'];
$message = $_POST['message'];

if( empty($errors))
{
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
		//	$response = $conn->query($authQuery);
			//	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.scoutlive.co.uk/firsttimelogin.php\">";
		}
	
	}
//if log in is successful set cookie for userid, redirect to profile.
if ($response->num_rows > 0){
		if($result = $response->fetch_assoc()){
			$userid = $result["id"];
			$username = $result["username"];
            $statusactive = $result["status"];
			//check if user is active
			if ($statusactive === "active"){
				$_SESSION["username"] = $username;
			$_SESSION["userid"] = $userid;
			echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/home.php\">";
			}
		/*	setcookie("userid", $userid, time() + (86400/24), "/", "scoutlive.co.uk");
			setcookie("username", $username, time() + (86400/24), "/", "scoutlive.co.uk");*/
else{
			

		//	echo password_hash('password', PASSWORD_MCRYPT);
			echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/index.html\">";
			
 echo "<script type='text/javascript'>alert('You need to activate your account')</script>";

		}
		}
	}
	
//if log in fails, direct back to log in screen - Needs to post something back, so we can use the post to display error message.
	else if(empty($_SESSION['username']))  {
echo "<meta http-equiv=\"refresh\" content=\"0;http://www.scoutlive.co.uk/login.php\">";

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
			//	header("location: http://www.scoutlive.co.uk/profile.php");
$errors = '';
$myemail = 'support@scoutlive.co.uk';
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
{
    $actual_link = "http://$_SERVER[HTTP_HOST]"."firsttimelogin.php?id=" . $_SESSION["username"];
	$to = $email_address;
    $email_subject = "Password change notification: $name";
    $email_body = "Your Scout password has just been changed, If this was not you please contact our support team immediately";
        
     //   "Email: $email_address";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    //redirect to the 'thank you' page
    header('Location:  http://www.scoutlive.co.uk/profile.php');
}
else {
    echo $errors;
}//NEED TO SEND POSITIVE RESPONSE BACK
			}
			//Old password doesn't match
			else{
				
				echo "<meta http-equiv=\"refresh\" content=\"0;http://www.scoutlive.co.uk/newpassword.php\">";
				//NEED TO SEND NEGATIVE RESPONSE
           echo "<script type='text/javascript'>alert('Incorrect Password combination')</script>";
;			}
		}
	}
}

?>







