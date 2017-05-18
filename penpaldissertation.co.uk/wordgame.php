<?php
session_start();

if (!isset($_SESSION['username'])) {
 
 echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/index.php\">";
 
 exit;
 
}
?>
<!DOCTYPE html>
<?php include

$servername = "localhost:3306";
$database = "scoutdatabase";
$dbusername = "markwatt";
$dbpassword = "Urn9nm8t";
$table = "progressTrack";

$submit = $_POST['submit'];
$formsubmit = $_POST['formsubmit'];
// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $database);



// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$_SESSION['englishaud'] = $existingEnglishAud;
$_SESSION['germAud'] = $existingGermanAud;
$_SESSION['English'] = $existingEnglishWord;
$_SESSION['German'] = $existingGermanWord;
$selectedtopic = $_SESSION['topic'];
$saveID = "1"; 
$penpalID="";
$PID = $_SESSION["PID"]; 
$usernameCookie = $_SESSION["username"];
$getExistingInfoQuery = "SELECT `saveStage`, `correctAnswer`, `timesCompleted`  FROM wordGame where `username` = '$usernameCookie'";
$updateInfoQuery=" UPDATE progressTrack SET saveStage='$saveID' WHERE `username` = '$usernameCookie'";
$insertInfoQuery = "INSERT INTO wordGame (`username`) VALUES ('$usernameCookie')";
$checkforusernameQuery = "SELECT username FROM progressTrack where `wordGame` = '$usernameCookie'";
$newGame ="UPDATE wordGame SET saveStage ='0', correctAnswer= '0' WHERE `username` = '$usernameCookie'";
$newGameneeded ="UPDATE wordGame SET saveStage ='999' WHERE `username` = '$usernameCookie'";
$getGermanEnglish ="SELECT `English` , `German`, `GermanAud`, `EnglishAud`  FROM wordDictionary where `ID` = '$selectedtopic' ORDER BY RAND() LIMIT 1 ";
$setupPenpal ="SELECT penpalID FROM penpalstore where `username` = '$usernameCookie'";
$getStage = "SELECT `saveStage` FROM progressTrack where `username` = '$usernameCookie'";
$updatetimesCompleted = "UPDATE wordGame SET `timesCompleted` = `timesCompleted` + 1 where `username` ='$usernameCookie'";

if($formsubmit){
	$userExists = $conn->query($checkforusernameQuery);
	if($userExists->num_rows > 0){
		$response = $conn->query($updateInfoQuery);
		
		echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/wordgame.php\">";

	}
	else {
		$response = $conn->query($insertInfoQuery);
		$response = $conn->query($newGame);
		
		//echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/wordgame.php\">";
	}	
}
if (isset($_POST['submit']) && $_SESSION['PID'] !== ''){
	
	
	$conn->query($newGame);
	
	$myemail = 'update@penpal.co.uk';
$email_address = $_SESSION['PID'];
$message = $_POST['message'];

	
	
$to = $email_address;
    $email_subject = "Penpal Progression";
    $email_body = "Your PenPal: {$usernameCookie} has just completed another level on WordGame!'\n.
	Ihre PenPal: {$usernameCookie} Hat gerade eine andere Ebene abgeschlossen in WortSpiel!'\n
    Done fall behind, Play today!!/Fallen nicht dahinter!!\n".
	"All of your Penpal settings can be reached from your main dashboard/Alle Ihre PenPal einstellung können aus deinem Armaturenbrett erreicht werden".
	
    //    "Email: $email_address";
	$headers .= "";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    //redirect to the 'thank you' page
	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/wordgame.php\">";
	
}else if (isset($_POST['submit']) && $_SESSION['PID'] === ''){
	
	$conn->query($newGame);
}
	
	


$response = $conn->query($setupPenpal);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$PID = $result["penpalID"];
		$_SESSION["PID"] = $PID;
	}
} else{
	
	$PID = "";
	
}
	
	


//ASSIGN EXISTING VALUES FROM DATABASE TO VARS FOR USE IN FORM
$response = $conn->query($getExistingInfoQuery);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$existingusername = $result["username"];
		$existingsaveID = $result["saveStage"];
		$existingCorrect = $result["correctAnswer"];
		$existingtimescompleted =$result["timesCompleted"];
		
	}
}
		else {
	$existingusername = "";
	$existingsaveID = "";	
	$existingCorrect = "";
	$existingtimescompleted="";
		}
		
		
$response = $conn->query($getGermanEnglish);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){		
		$existingEnglishWord = $result["English"];
		$existingGermanWord = $result["German"];
		$existingGermanAud = $result["GermanAud"];
		$existingEnglishAud = $result["EnglishAud"];
		$_SESSION['German'] = $existingGermanWord;
		$_SESSION['English'] = $existingEnglishWord;
		$_SESSION['germaud'] = $existingGermanAud;
		$_SESSION['englishaud'] = $existingEnglishAud;
	}
}
    else {
		$existingEnglishWord ="";
		$existingGermanWord ="";
		$existingGermanAud ="";
		$existingEnglishAud ="";
		}

if (isset($_POST['topicnumber'])){
	
	if ($_POST['topicnumber'] === "Eating out") {
		
		$_SESSION['topic'] = '1';
		$conn->query($newGameneeded);
		echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/wordgame.php\">";
	} else if ($_POST['topicnumber'] === "Family") {
	$_SESSION['topic'] = '2';
	$conn->query($newGameneeded);
	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/wordgame.php\">";
} else if ($_POST['topicnumber'] === "Hobbies") {
	$_SESSION['topic'] = '3';
	$conn->query($newGameneeded);
	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/wordgame.php\">";
} else{
	
	echo "notworking";
}
}		

?>





<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PenPal! - The easy way to learn German!</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/hallologo.png">
    <!-- Theme CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

	 <!--Javascript -->
	<script type="text/javascript" src="js/translate.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
	<!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">


</head>

<body id="page-top" class="index">

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="index.php">PenPal!</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="index.php"></a>
                </li>
                <li class="page-scroll">
                    <a href="logout.php"><div data-translate="Logout"></div></a>
                </li>
                <li class="page-scroll">
                    <a href="accountsettings.php"><div data-translate="Account Settings"></div></a>
                </li>
                <li class="page-scroll">
                    <a href="home.php"><div data-translate="Dashboard"></div></a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
               
                <div class="intro-text">
                    <span class="name"><div data-translate="Simple Word Game"></div></span>
					</div>
            </div>
        </div>
    </div>
</header> 

 <!-- main body of page -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><div data-translate="What is the German translation?"></div></h2>
                    <hr class="star-primary"> 
                </div>
            </div>
			<div class= "row">
			<div class="col-lg-12 text-center" style=" ">
			<!-- Introduction to word game -->
			<?php
			if($existingsaveID == '') : ?>
			<?php $_SESSION['topic'] = '1'; ?>
		        <form method="post" action="wordgame.php" >
			
					
		 
	   
		
						<h3><div data-translate="Click here to start a new game!"></div> </h3>
			
						<input class="link1" type="submit" name="formsubmit"  value="   Start   " />
			    </form>		
			
			<?php endif; ?>			
					
			<!-- Round of games -->
			
			<?php
				if (!isset($_COOKIE['nativeLang']) && $existingsaveID <= '9' && $existingsaveID > '-1' ): ?>
				
			    <form method="POST" action="checkanswer.php" >
			        <h3>Round <?php echo $existingsaveID +1 ?>! </h3>
			     <h3><div style=" float:left;" ><input type="text"  style="max-width:10em; height:5em; text-align:center; background-color:#A9A9A9; color:white;" value="<?php echo $existingEnglishWord ?>"readonly /></div></h3>
						<h3><div style=" float:right;" ><input type="text" style="max-width:10em; height:5em; text-align:center; background-color:#A9A9A9; color:white;" name="guessword"  /></div></h3>
						<input class="link1" type="submit" name="checkanswer" value="Submit Answer" />
		        </form>	
	<audio controls>
      <source src="<?php echo $existingGermanAud; ?>"/>
   </audio>				
					<button>Click for a Hint..</button>
                           <p></p>
                               <p style="display: none"><?php echo $existingGermanWord?></p>
			<?php endif; ?>	
			
			<?php
				if (isset($_COOKIE['nativeLang']) && $existingsaveID <= '9' && $existingsaveID > '-1' ): ?>
				
			    <form method="POST" action="checkanswer.php" >
			        <h3>Round <?php echo $existingsaveID +1 ?>! </h3>
			     <h3><div style=" float:left;" ><input type="text"  style="height:5em; text-align:center; background-color:#A9A9A9; color:white;" value="<?php echo $existingGermanWord ?>"readonly /></div></h3>
						<h3><div style=" float:right;" ><input type="text" style="height:5em; text-align:center; background-color:#A9A9A9; color:white;" name="guesswordgerman"  /></div></h3>
						<input class="link1" type="submit" name="checkanswer" value="Submit Answer" />
		        </form>		
	<audio controls>
      <source src="<?php echo $existingEnglishAud; ?>"/>
   </audio>
					<button>Click for a Hint..</button>
                           <p></p>
                               <p style="display: none"><?php echo $existingEnglishWord?></p>
			<?php endif; ?>	
			
			
			<!-- Diaplay image for correct/incorrect Answer -->
			<?php if(isset($_SESSION['correct'])) :    ?>
		<?php unset($_SESSION['correct'])?>
			<img src="img/Welldone.png" />
			<?php endif; ?>
			<?php if(isset($_SESSION['wrong'])) :    ?>
		<?php unset($_SESSION['wrong'])?>
			<img src="img/tryagain.png" />
			<?php endif; ?>
			
			
			<script>
$("img").show();
setTimeout(function() { $("img").hide(); }, 2500);
</script>
			
			
			<!-- End of test, display users ability level from progressTrack -->
		<?php
				if ( $existingsaveID== '10' ): ?>
		

    <h3>You scored <?php echo $existingCorrect?>  out of 10, and this is attempt   <?php echo $existingtimescompleted   ?> at this game</h3>
	 <form method="post" action="wordgame.php" >
	
				<h3> Select another Topic for the next round! </h3>
		 <h3><input type="submit" name="topicnumber"  value="Eating out" style="width:8em;" />&emsp;<br>   
		    <input type="submit" name="topicnumber"  value="Family" style="width:8em;" />&emsp;<br>     
		  <input type="submit" name="topicnumber"  value="Hobbies" style="width:8em;"/>&emsp;<br>     
				</form>		
			<?php endif; ?>	
			<?php
				if ( $existingsaveID== '999' ): ?>
				<?php $conn->query($updatetimesCompleted); ?>


	 <form method="post" action="wordgame.php" >
	<input class="link1" type="submit" name="submit"  value="   Start again  " />
				
		 
				</form>		
			<?php endif; ?>	
			
</div>
</div>				
			</div>				
			
			
			
			
	<!-- script needed for hint -->
					
 
<script>
$( "button" ).click(function() {
  $( "p" ).toggle().hide(2000);

});

</script>
	<!--<audio controls="controls" >
        <source src="http://www.penpaldissertation.co.uk/audiofiles/Hallo.mp3" type="audio/mp3" />	

		</audio>	-->
 </div>
 


 </section>
 		<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4">
                    <h3>Exit</h3>
                   
                </div>
                <div class="footer-col col-md-4">
                    <h3>New Game</h3>
                    
                </div>
                <div class="footer-col col-md-4">
                    <h3>Settings</h3>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                
            </div>
        </div>
    </div>
</footer>
<!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>
<script src="js/contact_me.js"></script>

<!-- Theme JavaScript -->
<script src="js/freelancer.min.js"></script>


     <script>   
change_lang();
</script>
	</body>
	
	</html>