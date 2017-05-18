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
$table = "penpalstore";


// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$test = $_POST['test'];
$sendtest = $_POST['sendtest'];
$ReportPID = $_POST['ReportPID'];
$DeletePID = $_POST['DeletePID'];
$formsubmit = $_POST['formsubmit'];
$PID = $_SESSION["PID"]; 
$usernameCookie = $_SESSION["username"];
$getExistingInfoQuery = "SELECT username FROM penpalstore where `username` = '$usernameCookie'";
$setupPenpal ="SELECT penpalID FROM penpalstore where `username` = '$usernameCookie'";
$gettimescompletedword = "SELECT `timesCompleted` FROM wordGame where `username` ='$PID'";
$gettimescompletedpuzzle = "SELECT `timesCompleted` FROM puzzleGame where `username` ='$PID'";
$gettimescompleteddrag = "SELECT `timesCompleted` FROM dragGame where `username` ='$PID'";
$Deleteyou = "UPDATE penpalstore SET penpalID = '' WHERE `username` = '$usernameCookie'";
$Deleteme = "UPDATE penpalstore SET penpalID = '' WHERE `username` = '$PID'";
$Reportyou ="UPDATE penpalstore SET `Reported` = '1' WHERE `username` = '$PID'";

if($DeletePID){
	$conn->query($Deleteyou);
	$conn->query($Deleteme);
    }

if($ReportPID){
	$conn->query($Reportyou);
	}

$response = $conn->query($getExistingInfoQuery);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$existingusername = $result["username"];
		
	}
}
		else {
	$existingusername = "";

		}
	

$response = $conn -> query($gettimescompletedword);
if ($response -> num_rows > 0) {
    if ($result = $response -> fetch_assoc()) {
        
	
		$completedenoughword = $result["timesCompleted"];



    }
} else {
	 
    $completedenoughword = "";

}
$response = $conn -> query($gettimescompletedpuzzle);
if ($response -> num_rows > 0) {
    if ($result = $response -> fetch_assoc()) {
        $completedenoughpuzzle = $result["timesCompleted"];



    }
} else {
    $completedenoughpuzzle = "";

}
$response = $conn -> query($gettimescompleteddrag);
if ($response -> num_rows > 0) {
    if ($result = $response -> fetch_assoc()) {
        $completedenoughdrag = $result["timesCompleted"];



    }
} else {
    $completedenoughdrag = "";

}


	
$response = $conn->query($setupPenpal);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$PID = $result["penpalID"];
		$_SESSION["PID"] = $PID;
	}
}
		
	

if ($PID === ""){
	// echo "<script type='text/javascript'>alert('no penpal');</script>";
	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/newpenpal.php\">";
		
	}	


if ($test){
	
	
	unset($_POST['sendtest']);
	
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

	<!--JavaScript -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/translate.js"></script>
	
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
            <a class="navbar-brand" href="#page-top">PenPal!</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
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
				<li class="page-scroll">
                    <a href="chat/index.php">Chat messenger</a>
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
               	<?php if(!$sendtest) : ?>
                <div class="intro-text">
                    <span class="name"><div data-translate="Here are all the details about your PenPal!"></div></span>
					</div>
					<?php endif; ?>
            </div>
        </div>
    </div>
</header> 
<?php if(!$sendtest)   :?>
 <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php if($formsubmit) :?>
			
			<form method="post" action="penpalsettings.php">
			<div class="6u 12u(mobilep)">
						<h3><div data-translate="Youre about to delete your penpal, continue?"></div></h3>
			<input type="submit" name="DeletePID"  value="Delete PenPal" /><input type="submit"  value="Cancel" /><input type="submit" name="ReportPID"  value="Report Abuse" />
			</div>
						</form>
			<?php endif;  ?>
                    <hr class="star-primary">
						
                </div>
            </div>
			  <div class="col-lg-8 col-lg-offset-2">
			<form method="post" action="penpalsettings.php">
			<div class="6u 12u(mobilep)">
						<h3><div data-translate="Your penpal is"></div> <input type="text"  value="<?php echo $PID ?>" readonly /> </h3>
						
						<input type="submit" name="formsubmit"  value="Delete" />
						</div>
						</form>
						
						
			<form action="leveltest.php">
			<div class="6u 12u(mobilep)">
						<h3><div data-translate="Your penpals currently at Completion level"></div> <input type="text"  style="width:2em;" value="<?php if($completedenoughword === null){ echo '0'; }else { echo $completedenoughword; } ?>" readonly /><div data-translate="in the word game"></div></h3>
						<h3><div data-translate="Your penpals currently at Completion level"></div> <input type="text" style="width:2em;" value="<?php if($completedenoughpuzzle === null){ echo '0'; }else { echo $completedenoughpuzzle; }?>" readonly /><div data-translate="in the puzzle game"></div></h3>
						<h3><div data-translate="Your penpals currently at Completion level"></div> <input type="text" style="width:2em;" value="<?php if($completedenoughdrag === null){ echo '0'; }else { echo $completedenoughdrag; }?>" readonly /><div data-translate="in the Drag game"></div></h3>
						<h4><div data-translate="Remember"></div> </h4>
						<input type="submit"   value="Take the test!" />
						</div>
						</form>
			
						
			
			<h3><a href="chat/" onclick="openWindow(this.href);this.blur();return false;">Open PenPal Chat <</a></h3>
			<form method="post" action="penpalsettings.php">
			<div class="6u 12u(mobilep)">
						<h3><div data-translate="Send your PenPal Questions to answer!"></div></h3>
						
						<input type="submit" id="sendtest" name="sendtest"  value="Send Questions" />
						</div>
			</form>
            </div>
			</div>
    </section>
				  <!-- Contact Section -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><div data-translate="Message your PenPal"></div></h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
						<form method="POST" name="contactform" action="mail/contact_me.php">
                         
                            <textarea rows="5" class="form-control" style="background-color:black" placeholder="Message" name="message" required data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-success btn-lg">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>	
	</section>
	
	<?php endif; ?>
	<?php if($sendtest) : ?>
	
	
	  <!-- Contact Section -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><div data-translate="Test Your PenPal"></div></h2>
                <hr class="star-primary">
				<h4> <div data-translate="This area"></div> </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
						<form method="POST"  action="mail/contact_me.php">
                         
                            <textarea rows="3" class="form-control" style="background-color:black" placeholder="Question 1" name="q1" required data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                          <textarea rows="3" class="form-control" style="background-color:black" placeholder="Question 2" name="q2" required data-validation-required-message="Please enter a message."></textarea>
						
						  <p class="help-block text-danger"></p>
						  <textarea rows="3" class="form-control" style="background-color:black" placeholder="Question 3" name="q3" required data-validation-required-message="Please enter a message."></textarea>
						
						  <p class="help-block text-danger"></p>
						  <textarea rows="3" class="form-control" style="background-color:black" placeholder="Question 4" name="q4" required data-validation-required-message="Please enter a message."></textarea>
						
						</div>
						
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-success btn-lg">Send</button>
							
                        </div>
						
                    </div>
                </form>
				<form method="post" >
				<input type="submit" id="test" name="test"  value="Cancel" />
				</form>
            </div>
        </div>
    </div>	
	</section>
	<?php endif; ?>
		<!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>

<!-- Theme JavaScript -->
<script src="js/freelancer.min.js"></script>
<script type="text/javascript">
	// <![CDATA[
		function openWindow(url,width,height,options,name) {
			width = width ? width : 800;
			height = height ? height : 600;
			options = options ? options : 'resizable=yes';
			name = name ? name : 'openWindow';
			window.open(
				url,
				name,
				'screenX='+(screen.width-width)/2+',screenY='+(screen.height-height)/2+',width='+width+',height='+height+','+options
			)
		}
	// ]]>
</script>
     <script>   
change_lang();
</script>
	</body>
	
	</html>