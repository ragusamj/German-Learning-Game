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


$_SESSION['German'] = $existingGermanWord;
$saveID = "1"; 
$penpalID="";
$usernameCookie = $_SESSION["username"];
$getExistingInfoQuery = "SELECT `saveStage`, `standardLevel`  FROM progressTrack where `username` = '$usernameCookie'";
$updateInfoQuery=" UPDATE progressTrack SET saveStage='$saveID', standardLevel = '0' WHERE `username` = '$usernameCookie'";
$insertInfoQuery = "INSERT INTO progressTrack (`username`) VALUES ('$usernameCookie')";
$checkforusernameQuery = "SELECT username FROM progressTrack where `username` = '$usernameCookie'";
$newGame ="UPDATE progressTrack SET saveStage = '1', standardLevel ='0' WHERE `username` = '$usernameCookie'";
$newStandard ="UPDATE progressTrack SET standardLevel = '0' WHERE `username` = '$usernameCookie'";
$getGermanEnglish ="SELECT `English` , `German`  FROM wordDictionary where `ID` = '1' ORDER BY RAND() LIMIT 1";
//$getGermanWord = "SELECT `German` FROM wordDictionary where `German` = '$existingGermanWord'";
$getStage = "SELECT `saveStage` FROM progressTrack where `username` = '$usernameCookie'";
$getexistingAudio = "SELECT `GermanAud` FROM wordDictionary where `German` = 'Hallo' ";
$gettimescompletedword = "SELECT `timesCompleted` FROM wordGame where `username` ='$usernameCookie'";
$gettimescompletedpuzzle = "SELECT `timesCompleted` FROM puzzleGame where `username` ='$usernameCookie'";
$gettimescompleteddrag = "SELECT `timesCompleted` FROM dragGame where `username` ='$usernameCookie'";
$retake = "UPDATE progressTrack SET `saveStage` = '0' where `username` = '$usernameCookie'";
$percentCompleteBegin =" UPDATE progressTrack SET `percentComplete` =  `percentComplete` + 1 where `username`= '$usernameCookie'";
$percentCompleteInt =" UPDATE progressTrack SET `percentComplete` =  `percentComplete` + 3 where `username`= '$usernameCookie'";
$percentCompleteAdv =" UPDATE progressTrack SET `percentComplete` =  `percentComplete` + 5 where `username`= '$usernameCookie'";

if ($formsubmit) {
    $userExists = $conn -> query($checkforusernameQuery);
    if ($userExists -> num_rows > 0) {
        $response = $conn -> query($updateInfoQuery);
        // check this... think its not needed.
        echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/leveltest.php\">";

    } else {
        $response = $conn -> query($insertInfoQuery);
        $response = $conn -> query($newGame);
        $response = $conn -> query($newStandard);
        echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/leveltest.php\">";
        //echo "<script type='text/javascript'>alert('Wrong next level');</script>";
    }
}


if ($submit) {


   $conn -> query($retake);
    echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/home.php\">";


}



//selects saveID from progressTrack for testing
$response = $conn -> query($getExistingInfoQuery);
if ($response -> num_rows > 0) {
    if ($result = $response -> fetch_assoc()) {
        $existingusername = $result["username"];
        $existingsaveID = $result["saveStage"];
        $existingStandard = $result["standardLevel"];

    }
} else {
    $existingusername = "";
    $existingsaveID = "";
    $existingStandard = "";
}

//Selects German and English words from wordDictionary
$response = $conn -> query($getGermanEnglish);
if ($response -> num_rows > 0) {
    if ($result = $response -> fetch_assoc()) {
        $existingEnglishWord = $result["English"];
        $existingGermanWord = $result["German"];

        $_SESSION['German'] = $existingGermanWord;

    }
} else {
    $existingEnglishWord = "";
    $existingGermanWord = "";

}


$response = $conn -> query($gettimescompletedword);
if ($response -> num_rows > 0) {
    if ($result = $response -> fetch_assoc()) {
        $completedenough = $result["timesCompleted"];



    }
} else {
    $completedenough = "";

}

//NEED TO FIGURE OUT JOIN TABLE RATHER THAN CHECK BOTH TABLES SEPERATELY

$response = $conn -> query($gettimescompletedpuzzle);
if ($response -> num_rows > 0) {
    if ($result = $response -> fetch_assoc()) {
        $completedenough2 = $result["timesCompleted"];



    }
} else {
    $completedenough2 = "";

}
$response = $conn -> query($gettimescompleteddrag);
if ($response -> num_rows > 0) {
    if ($result = $response -> fetch_assoc()) {
        $completedenough3 = $result["timesCompleted"];



    }
} else {
    $completedenough3 = "";

}
//Selects German/English Audio files.
$response = $conn -> query($getexistingAudio);
if ($response -> num_rows > 0) {
    if ($result = $response -> fetch_assoc()) {
        $existingGermanAud = $result["GermanAud"];



    }
} else {
    $existingGermanAud = "";

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
                    <a href="#about"><div data-translate="Account Settings"></div></a>
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
                    <span class="name"><h1>Testing Area!</h1></span>
					</div>
            </div>
        </div>
    </div>
</header> 

 <!-- main body of page -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
				<?php if ( $existingsaveID <= '9' && $existingsaveID > '0' ): ?>
                <div class="col-lg-12 text-center">
                    <h2><div data-translate="What is the German translation?"></div></h2>
                    <hr class="star-primary"> 
					
                </div>
				<?php endif; ?>
            </div>
			<div class= "row">
			<div class="col-lg-12 text-center">
			<!-- Introduction to word game -->
			<!---------- for first time logins ------------------>
		<?php
			if($existingsaveID == null ) :  ?>
			
		        <form method="post" action="leveltest.php" >
			
						<h3><div data-translate="When youre ready"></div> </h3>
			
						<input class="link1" type="submit" name="formsubmit"  value="   Start   " />
			    </form>		
			
			<?php endif; ?>	






			
			
			<!---- for re-taking test ----->
			
			<?php
			if($existingsaveID == '0' && $completedenough == '10' && $completedenough2 == '10' && $completedenough2 == '10') :  ?>
			
		        <form method="post" action="leveltest.php" >
			
						<h3><div data-translate="Re-take the test?"></div> </h3>
			
						<input class="link1" type="submit" name="formsubmit"  value="   Start   " />
			    </form>		
			
			<?php endif; ?>			
			<?php
			if($existingsaveID == '0' && $completedenough !== '10' && $completedenough2 !== '10' && $completedenough2 !== '10') :  ?>
			
		        <form method="post" action="leveltest.php" >
			
						<h3><div data-translate="Come back when you have completed each game another 10 times!"><div> </h3>
			
						
			    </form>		
			
			<?php endif; ?>	
					<!----------------------------------------->
					
			<!-- Round 1 of games -->
			<?php
				if (!isset($_COOKIE['nativeLang']) && $existingsaveID <= '9' && $existingsaveID > '0' ): ?>
				
			    <form method="POST" action="checkanswer.php" >
			        <h3>Round <?php echo $existingsaveID  ?>! </h3>
			     <h3><div style=" float:left;" ><input type="text"  style="height:5em; text-align:center; background-color:#A9A9A9; color:white;" value="<?php echo $existingEnglishWord ?>"readonly /></div></h3>
						<h3><div style=" float:right;" ><input type="text" style="height:5em; text-align:center; background-color:#A9A9A9; color:white;" name="guess"  /></div></h3>
						<input class="link1" type="submit" name="checkanswer" value="Submit Answer" />
		        </form>	

			<?php endif; ?>	
			
			<?php
				if (isset($_COOKIE['nativeLang']) && $existingsaveID <= '9' && $existingsaveID > '0' ): ?>
				
			    <form method="POST" action="checkanswer.php" >
			        <h3>Round <?php echo $existingsaveID  ?>! </h3>
			     <h3><div style=" float:left;" ><input type="text"  style="height:5em; text-align:center; background-color:#A9A9A9; color:white;" value="<?php echo $existingGermanWord ?>"readonly /></div></h3>
						<h3><div style=" float:right;" ><input type="text" style="height:5em; text-align:center; background-color:#A9A9A9; color:white;" name="guessgerman"  /></div></h3>
						<input class="link1" type="submit" name="checkanswer" value="Submit Answer" />
		        </form>		
		
			<?php endif; ?>	
			
			
			
			<!-- End of test, display users ability level from progressTrack -->
		
			<?php 
			if($existingsaveID == '10' ) : ?>
			
			
		        <form method="POST" action="leveltest.php" >
		
						<h3>You scored <?php echo $existingStandard?>  out of 10</h3>
						<?php 
						if ($existingStandard === '0' || $existingStandard === '1' || $existingStandard === '2'  || $existingStandard === '3'){ 
						$str1 = "We are putting you in the beginners grouping, which has added 1% to your Completion Total!";
						$conn->query($percentCompleteBegin);
echo $str1;
						
						}else if ($existingStandard === '4' || $existingStandard === '5' || $existingStandard === '6' || $existingStandard === '7'){	
						$str2 = "We are putting you in the intermediate grouping, which has added 3% to your Completion Total!";
						$conn->query($percentCompleteInt);
echo $str2;
					
						}else if ($existingStandard ===  '8' || $existingStandard === '9' || $existingStandard === '10' ){
							$str3 = "We are putting you in the advanced grouping, which has added 5% to your Completion Total!";
							$conn->query($percentCompleteAdv);
echo $str3;
							
						}else {
							
							echo "error";
						} 
						
						?>
						<input type="submit" name="submit" value="Return to Dashboard" />
						
						
			    </form>	
</div>
</div>				
			</div>				
			<?php endif; ?>	
			
		
	<!-- script needed for hint -->
					
 
<script>
$( "button" ).click(function() {
  $( "p" ).toggle().hide(2000);
  $( "img" ).toggle().hide(2000);
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