<?php
session_start();

if (!isset($_SESSION['username'])) {
 
 echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/index.php\">";
 
 exit;
 
}
?>
<!DOCTYPE html>
<?php include
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

//Data needed for game
$submit = $_POST['submit'];
$formsubmit = $_POST['formsubmit'];
$usernameCookie = $_SESSION["username"];
$_SESSION['German'] = $existingGermanWord;
$_SESSION['GermanPhrase'] = $existingGermanPhrase;
$_SESSION['English'] = $existingEnglishWord;
$_SESSION['EnglishPhrase'] = $existingEnglishPhrase;
$name = $_COOKIE['Attempts'];

//MySQL queries
$setupPenpal ="SELECT penpalID FROM penpalstore where `username` = '$usernameCookie'";
$getGermanEnglishRandoms = "SELECT `German`, `English` FROM wordDictionary where `ID` = '1' ORDER BY RAND() LIMIT 3 ";
$getGermanEnglish ="SELECT `English` , `German`, `image`  FROM wordDictionary where `ID` = '1' ORDER BY RAND()";
$getGermanEnglishPhrase=" SELECT `EnglishP`, `GermanP` FROM phrasesDictionary where `ID` ='1' ORDER BY RAND()";
$getExistingInfoQuery = "SELECT `saveStage`, `correctAnswer`, `timesCompleted`  FROM dragGame where `username` = '$usernameCookie'";
$checkforusernameQuery = "SELECT username FROM dragGame where `username` = '$usernameCookie'";
$insertInfoQuery = "INSERT INTO dragGame (`username`) VALUES ('$usernameCookie')";
$newGame ="UPDATE dragGame SET saveStage ='0', correctAnswer= '0' WHERE `username` = '$usernameCookie'";
$levelCheck = "SELECT standardLevel from progressTrack where `username` = '$usernameCookie'"; 
$updatetimesCompleted = "UPDATE dragGame SET `timesCompleted` = `timesCompleted` + 1 where `username` ='$usernameCookie'";


if($formsubmit){
	$userExists = $conn->query($checkforusernameQuery);
	if($userExists->num_rows > 0){

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

//Email users PenPAl to notify of progression in game
$to = $email_address;
    $email_subject = "Penpal Progression";
    $email_body = "Your PenPal: {$usernameCookie} has just completed another level on DragGame!'\n.
	Ihre PenPal: {$usernameCookie} Hat gerade eine andere Ebene abgeschlossen in DragSpiel!'\n
    Done fall behind, Play today!!/Fallen nicht dahinter!!\n".
	"All of your Penpal settings can be reached from your main dashboard/Alle Ihre PenPal einstellung können aus deinem Armaturenbrett erreicht werden".

	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
	
    //redirect back to game
	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/draggame.php\">";
	
}else if (isset($_POST['submit']) && $_SESSION['PID'] === ''){
	
	$conn->query($newGame);
}
	


//Code for getting user info from penpalstore
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

// Code for fetching wordDictionary items 
$response = $conn->query($getGermanEnglish);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){		
		$existingEnglishWord = $result["English"];
		$existingGermanWord = $result["German"];
		$image =$result["image"];
		$_SESSION['German'] = $existingGermanWord;
	    $_SESSION['English'] = $existingEnglishWord;
	}
}
    else {
		$existingEnglishWord ="";
		$existingGermanWord ="";
		$image = "";
	
		}
//Code for fetching phrasesDictionary items
$response = $conn->query($getGermanEnglishPhrase);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){		
		$existingEnglishPhrase = $result["EnglishP"];
		$existingGermanPhrase = $result["GermanP"];
		$_SESSION['germanPhrase'] = $existingGermanPhrase;
	    $_SESSION['englishPhrase'] = $existingEnglishPhrase;
	}
}
    else {
		$existingEnglishPhrase ="";
		$existingGermanPhrase ="";
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
	$randomEnglish1 ="";
	$randomEnglish2="";
	$randomEnglish3="";
		}
	
}
// Code for fetching standard level from progress track, based on username */

$response= $conn->query($levelCheck);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){		
		$existingLevel = $result["standardLevel"];	
	}
}
    else {
		$existingLevel ="";
		}
//Code for getting users PenPalID
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script type="text/javascript" src="./js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="./js/jquery-ui-1.8.8.custom.min.js"></script>
	<script type="text/javascript" src="./js/jquery.ui.multidraggable-1.8.8.js"></script>
	
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>
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
                    <span class="name"><div data-translate="Complete the sentence"></div></span>
	                    <h2><div data-translate="Drag"></div></h2>
				</div>
            </div>
        </div>
    </div>
</header> 

 <!-- main body of page -->
    <section id="portfolio">
        <div class="container"> 
			<!-- Game Template -->
			<!-- save stage = 0 so means first time played. -->
			<?php if (!isset($_COOKIE['nativeLang']) && $existingsaveID <= '9' && $existingsaveID > '-1') : ?>
			<div class="col-lg-12 text-center">
                    <h3> <div data-translate="The English" ></div><?php echo $existingEnglishPhrase ?> </h3>
                    <hr class="star-primary">
					<?php echo $_COOKIE['Attempts']; ?>		
                </div>
			
			<?php endif; ?>
			<?php if (isset($_COOKIE['nativeLang']) && $existingsaveID <= '9' && $existingsaveID > '-1') : ?>
			<div class="col-lg-12 text-center">
                    <h3> <div data-translate="The English" ></div><?php echo $existingGermanPhrase ?> </h3>
                    <hr class="star-primary">
					<?php echo $_COOKIE['Attempts']; ?>		
                </div>
			
			<?php endif; ?>
			
			<?php
			if($existingsaveID == '') : ?>
			<div class="div1">
		        <form method="post" action="draggame.php" >
			<div class="6u 12u(mobilep)">
				<h3><div data-translate="Click here to begin the game!" ></div></h3>	 
			</div>
				<input class="link1" type="submit" name="formsubmit"  value="   Start  " />
			    </form>		
			</div>	
			<?php endif; ?>	
		<!--------------------------------------------------->
		<!--------------- When save id reaches 10, give score then offer to start again ----->
		<?php if ( !isset($_COOKIE['nativeLang']) && $existingsaveID== '10' ): ?>
			<?php $conn->query($updatetimesCompleted); ?>
                <h3>You scored <?php echo $existingCorrect?>  out of 10, and this is attempt   <?php echo $existingtimescompleted  ?> at this game</h3>
	            <form method="post" action="draggame.php" >
	                 <input class="link1" type="submit" name="submit"  value="   Start again  " />
				</form>		
		<?php endif; ?>	
		<?php if ( isset($_COOKIE['nativeLang']) && $existingsaveID== '10' ): ?>
			<?php $conn->query($updatetimesCompleted); ?>
                <h3>Sie erzielten  <?php echo $existingCorrect?>  von 10, und das ist attemt Nummer  <?php echo $existingtimescompleted  ?> bei diesem Spiel</h3>
	            <form method="post" action="draggame.php" >
	                 <input class="link1" type="submit" name="submit"  value="   Start again  " />
				</form>		
		<?php endif; ?>	
		<!---------------------------------------------------->
		
		

			   
	
			
		<!------ The choice of words to match the image ----->
		<div class="row">
		
		   <?php if (!isset($_COOKIE['nativeLang']) && $existingsaveID <= '9' && $existingsaveID > '-1' ): ?>
		<div class="col-sm-7 portfolio-item">
           
		
	<?php
	$sentence = $existingGermanPhrase;
    $sentence = explode(' ', $sentence); 
    $position = rand(0, count($sentence) - 1);
    $answer = $sentence[$position];
    $sentence[$position] = '<input type="text" style=" background-color: black; width:6em;" name="fillBlank" readonly />';
   
	
	?>
	<h3> <?php echo implode(" ", $sentence);?> </h3>
	
	
	
	
	</div>

	
			
		<?php 
		
		$input = $existingGermanPhrase;
		
		$input = array("$answer", "$randomGerman1", "$randomGerman2");
		shuffle ($input );
		?>
		<div class="col-sm-3 portfolio-item">
		
		<div id="guess1">
              <h3><?php echo $input[0] ?></h3>
        </div>
<br>
        <div id="guess2">
              <h3><?php echo $input[1] ?></h3>
        </div>
<br>	
        <div id="guess3">
              <h3><?php echo $input[2] ?></h3>
        </div>  
		
        
    </div>
    	<?php endif; ?>
	
	
		   <?php if (isset($_COOKIE['nativeLang']) && $existingsaveID <= '9' && $existingsaveID > '-1' ): ?>
		<div class="col-sm-7 portfolio-item">
           
		
	<?php
	$sentence = $existingEnglishPhrase;
    $sentence = explode(' ', $sentence); 
    $position = rand(0, count($sentence) - 1);
    $answer = $sentence[$position];
    $sentence[$position] = '<input type="text" style=" background-color: black; width:6em;" name="fillBlank" readonly />';
   
	
	?>
	<h3> <?php echo implode(" ", $sentence);?> </h3>
	
	
	
	
	</div>

	
			
		<?php 
		
		$input = $existingEnglishPhrase;
		
		$input = array("$answer", "$randomEnglish1", "$randomEnglish2");
		shuffle ($input );
		?>
		<div class="col-sm-3 portfolio-item">
		
		<div id="guess1">
              <h3><?php echo $input[0] ?></h3>
        </div>
<br>
        <div id="guess2">
              <h3><?php echo $input[1] ?></h3>
        </div>
<br>	
        <div id="guess3">
              <h3><?php echo $input[2] ?></h3>
        </div>  
		
        
    </div>
    	<?php endif; ?>
	
	
	</div>
			
			
</div>
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

	

</section>

<script>
//Javascript from JQUERY draggable, edited by myself to check answer of dropped element 
var $answer =  "<?php Print($answer); ?>";
var $guess1 =  "<?php Print($input[0]); ?>";
var $guess2 =  "<?php Print($input[1]); ?>";
var $guess3 =  "<?php Print($input[2]); ?>";
	
var draggableId = null;
var droppableId = null;
var attempts = null;


	
	$(document).ready(function() {
    $("#guess1").draggable(); //creating draggable elements
    $("#guess2").draggable();  
	$("#guess3").draggable();  
    $("input").droppable({
      drop: function(event,ui) {
      var draggableId = ui.draggable.attr("id")
      var droppableId = $(this).attr("id");
      console.log($answer);
	  var attempts = '1';
    if  ( draggableId === ("guess1")){ 
      
		document.getElementById("guess1").setAttribute('id','$guess1');
	  console.log($guess1);  
	
	   if ($answer === $guess1) {
	document.cookie = "Attempts="+attempts+";expires=Thu, 18 Dec 2018 12:00:00 UTC;path=/";
	  window.location.href = "deletecookie.php";
    }else {
		 window.location.href = "deletecookie.php";
	}
	
	  } else if ( draggableId === ("guess2")){
		  
		 document.getElementById("guess2").setAttribute('id','$guess2');
	  
       if ($answer === $guess2) {
	 
	  document.cookie = "Attempts="+attempts+";expires=Thu, 18 Dec 2018 12:00:00 UTC;path=/";
	   window.location.href = "deletecookie.php";
    } else {
		
		 window.location.href = "deletecookie.php";
	}
	  } 
    else if ( draggableId === ("guess3")){
		  
		 document.getElementById("guess3").setAttribute('id','$guess3');
		  
       if ($answer === $guess3) {
		   
	  document.cookie = "Attempts="+attempts+";expires=Thu, 18 Dec 2018 12:00:00 UTC;path=/";
	   window.location.href = "deletecookie.php";
    } else {
	
		  window.location.href = "deletecookie.php";
	}
	  }  	  
	  }
	  });
    });
 

 
   

			
	</script>
	
	
 <script>
change_lang();
</script>
	</body>
	
	</html>