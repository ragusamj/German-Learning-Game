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



// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $database);



// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
$submit = $_POST['submit'];
$formsubmit = $_POST['formsubmit'];
$usernameCookie = $_SESSION["username"];
$_SESSION['German'] = $existingGermanWord;
$puzzleguess = $_POST['guesspuzzle'];
$setupPenpal ="SELECT penpalID FROM penpalstore where `username` = '$usernameCookie'";
$_SESSION['English'] = $existingEnglishWord;
$getGermanEnglishRandoms = "SELECT `German`, `English` FROM wordDictionary where `ID` = '1' ORDER BY RAND() LIMIT 3 ";
$getGermanEnglish ="SELECT `English` , `German`, `image`  FROM wordDictionary where `ID` = '1' ORDER BY RAND()";
$getExistingInfoQuery = "SELECT `saveStage`, `correctAnswer`, `timesCompleted`  FROM puzzleGame where `username` = '$usernameCookie'";
$checkforusernameQuery = "SELECT username FROM puzzleGame where `username` = '$usernameCookie'";
$insertInfoQuery = "INSERT INTO puzzleGame (`username`) VALUES ('$usernameCookie')";
$newGame ="UPDATE puzzleGame SET saveStage ='0', correctAnswer= '0' WHERE `username` = '$usernameCookie'";
$levelCheck = "SELECT standardLevel from progressTrack where `username` = '$usernameCookie'"; 
$updatetimesCompleted = "UPDATE puzzleGame SET `timesCompleted` = `timesCompleted` + 1 where `username` ='$usernameCookie'";

if($formsubmit){
	$userExists = $conn->query($checkforusernameQuery);
	if($userExists->num_rows > 0){
		
echo "error youve already started this game";
	}
	else {
		$response = $conn->query($insertInfoQuery);
		$response = $conn->query($newGame);
	
	}	
}

if (isset($_POST['submit']) && $_SESSION['PID'] !== ''){
	
	
	$conn->query($newGame);
	
	$myemail = 'update@penpal.co.uk';
$email_address = $_SESSION['PID'];
$message = $_POST['message'];


	
	
$to = $email_address;
   $email_subject = "Penpal Progression";
    $email_body = "Your PenPal: {$usernameCookie} has just completed another level on PuzzleGame!'\n.
	Ihre PenPal: {$usernameCookie} Hat gerade eine andere Ebene abgeschlossen in PuzzelSpiel!'\n
    Done fall behind, Play today!!/Fallen nicht dahinter!!\n".
	"All of your Penpal settings can be reached from your main dashboard/Alle Ihre PenPal einstellung können aus deinem Armaturenbrett erreicht werden".
	
    //    "Email: $email_address";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    //redirect to the 'thank you' page
	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/puzzlegame.php\">";
	
}else if (isset($_POST['submit']) && $_SESSION['PID'] === ''){
	
	$conn->query($newGame);
}
	
	
	
	


//Code for checking the save stage the user is at
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

// Code for fetching wordDictionary items based on save stage and standardLevel
$response = $conn->query($getGermanEnglish);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){		
		$existingEnglishWord = $result["English"];
		$existingGermanWord = $result["German"];
		$existingimage =$result["image"];
		$_SESSION['German'] = $existingGermanWord;
		$_SESSION['English'] = $existingEnglishWord;
	}
}
    else {
		$existingEnglishWord ="";
		$existingGermanWord ="";
		$existingimage = "";
	
		}
		
	// code for random answers	
$response = $conn->query($getGermanEnglishRandoms);
if($response->num_rows > 0){
    if($result = $response->fetch_assoc()){		
	$randomGerman1 =  $result ["German"];
	$randomEnglish1 = $result["English"];
	}
	if($result = $response->fetch_assoc()){	
	$randomGerman2 =  $result ["German"];
	$randomEnglish2 = $result["English"];
	}
	if($result = $response->fetch_assoc()){	
    $randomGerman3 =  $result ["German"];
	$randomEnglish3 = $result["English"];
	}

    else {
	
	$randomGerman1="";
    $randomGerman2="";
    $randomGerman3="";
	$randomEnglish1 = "";
	$randomEnglish2="";
	$randomEnglish3="";
		}
	
}
	
	
	
	
/* Code for fetching standard level from progress track, based on username */

$response= $conn->query($levelCheck);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){		
		$existingLevel = $result["standardLevel"];
		
				//setcookie("standardLevel", $existingLevel,time() + (86400 * 30), "/");
			
	}
}
    else {
		$existingLevel ="";
		

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
                    <span class="name"><div data-translate="Puzzle Game"></div></span>
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
                    <h2><div data-translate="Match the picture to the word"></div></h2>
					  
                   <hr class="star-primary">
                </div>
           
			
			
			</div>
			<!-- Game Template -->
			
			
			<!-- save stage = 0 so means first time played. -->
			<?php
			if($existingsaveID == '') : ?>
			<div class="div1">
		        <form method="post" action="puzzlegame.php" >
			<div class="6u 12u(mobilep)">
						<h3><div data-translate="Click here to start a new game!"></div></h3>
			</div>
						<input class="link1" type="submit" name="formsubmit"  value="   Start   " />
			    </form>		
			</div>	
			<?php endif; ?>	
			<!--------------------------------------------------->
			<!--------------- When save id reaches 10, give score then offer to start again ----->
				<?php
				if ( $existingsaveID== '10' ): ?>
				<?php $conn->query($updatetimesCompleted); ?>

    <h3>You scored <?php echo $existingCorrect?>  out of 10, and this is attempt   <?php echo $existingtimescompleted  ?> at this game</h3>
	 <form method="post" action="puzzlegame.php" >
	<input class="link1" type="submit" name="submit"  value="   Start again  " />
				</form>		
			<?php endif; ?>	
		
		<!---------------------------------------------------->
		
			<!------- the image for the test --->
			<div class="row">
			<div class="col-sm-5 portfolio-item">
  <?php
				if ( $existingsaveID <= '9' && $existingsaveID > '-1' ): ?>
				
				
<img src=" <?php echo $existingimage; ?>" style="max-width:auto; max-height:auto;"/>
		
			</div>
			<!----------------------------------->
			
			<!------ The choice of words to match the image ----->
		
			
			<?php if (isset($_SESSION['username']) && !isset($_COOKIE['nativeLang'])) : 
			$input = array("$existingGermanWord", "$randomGerman1", "$randomGerman2", "$randomGerman3");
			
		shuffle ($input );
			
			
			?>
				<div class="col-sm-5 portfolio-item">
				<?php if(isset($_SESSION['correct'])) :    ?>
		<?php unset($_SESSION['correct'])?>
	    <h5> Correct Welldone! </h5>
			<?php endif; ?>
			<?php if(isset($_SESSION['wrong'])) :    ?>
		<?php unset($_SESSION['wrong'])?>
		<h5> Not correct, try again! </h5>
			<?php endif; ?>
			<form method="POST" action="checkanswer.php" >
		 <h3><input type="submit" name="guesspuzzle"  value="<?php echo $input[0] ?>" style="width:8em;" />&emsp;<br>   
		    <input type="submit" name="guesspuzzle"  value="<?php echo $input[1] ?>"style="width:8em;" />&emsp;<br>     
		  <input type="submit" name="guesspuzzle"  value="<?php echo $input[2] ?>" style="width:8em;"/>&emsp;<br>     
			<input type="submit" name="guesspuzzle"  value="<?php echo $input[3] ?>" style="width:8em;"/>&emsp;<br>     
			</form>
			</div>
			
			<div class="col-sm-2 portfolio-item">
			
			
			<button>Click for a Hint..</button>
			<p style="display: none"><?php echo $existingGermanWord?></p>
			
			
			</div>
			<?php endif; ?>
			
			
			<?php if (isset($_COOKIE['nativeLang'])) : 
			$input = array("$existingEnglishWord", "$randomEnglish1", "$randomEnglish2", "$randomEnglish3");
			
		shuffle ($input );
			?>
			<div class="col-sm-5 portfolio-item">
				<?php if(isset($_SESSION['correct'])) :    ?>
		<?php unset($_SESSION['correct'])?>
	    <h5>Richtig! Gut gemacht</h5>
			<?php endif; ?>
			<?php if(isset($_SESSION['wrong'])) :    ?>
		<?php unset($_SESSION['wrong'])?>
		<h5> Nicht richtig, wieder versuchen! </h5>
			<?php endif; ?>
			<form method="POST" action="checkanswer.php" >
		 <h3><input type="submit" name="guesspuzzlegerman"  value="<?php echo $input[0] ?>" style="width:8em;" />&emsp;<br>   
		    <input type="submit" name="guesspuzzlegerman"  value="<?php echo $input[1] ?>"style="width:8em;" />&emsp;<br>     
		  <input type="submit" name="guesspuzzlegerman"  value="<?php echo $input[2] ?>" style="width:8em;"/>&emsp;<br>     
			<input type="submit" name="guesspuzzlegerman"  value="<?php echo $input[3] ?>" style="width:8em;"/>&emsp;<br>     
			</form>
			</div>
			
			<div class="col-sm-2 portfolio-item">
			
			
			<button>Click for a Hint..</button>
			<p style="display: none"><?php echo $existingEnglishWord?></p>
			
			
			</div>
			<?php endif; ?>
			<!------------------------------------------>
		
				<script>
$("h5").show();
setTimeout(function() { $("h5").hide(); }, 2500);
</script>
			
			<!-- Hint button --->
			
			<!------------------------------------------>
			
			</div>
			</div>
			<?php endif; ?>
		
			  
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
	

 </section>
<script>
$( "button" ).click(function() {
  $( "p" ).toggle().hide(2000);
});
</script>
 <script>
change_lang();
</script>
	</body>
	
	</html>