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
$DeleteAccount = $_POST['DeleteAccount'];
$formdelete = $_POST['formdelete'];
$formsubmit = $_POST['formsubmit'];
$usernameCookie = $_SESSION["username"];
$getExistingInfoQuery = "SELECT username FROM penpalstore where `username` = '$usernameCookie'";
$updateInfoQuery= "UPDATE penpalstore SET penpalID='' where `username` = '$usernameCookie'";
$gettimescompletedword = "SELECT `timesCompleted` FROM wordGame where `username` ='$usernameCookie'";
$gettimescompletedpuzzle = "SELECT `timesCompleted` FROM puzzleGame where `username` ='$usernameCookie'";
$gettimescompleteddrag = "SELECT `timesCompleted` FROM dragGame where `username` ='$usernameCookie'";
$deleteFull = "UPDATE `penpalstore` SET `username` = '' where `username` ='$usernameCookie'";

$response = $conn->query($getExistingInfoQuery);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$existingusername = $result["username"];
		$existingpenpalID = $result["penpalID"];
	}
}
		else {
	$existingusername = "";
	$existingpenpalID = "";	
		}
		
		
if($formsubmit){
	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/leveltest.php\">";
}
if($DeleteAccount){
	
}

$response = $conn -> query($gettimescompletedword);
if ($response -> num_rows > 0) {
    if ($result = $response -> fetch_assoc()) {
        $completedenoughword = $result["timesCompleted"];



    }
} else {
    $completedenoughword = "";

}

//NEED TO FIGURE OUT JOIN TABLE RATHER THAN CHECK BOTH TABLES SEPERATELY

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
    $completedenough3 = "";

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
                    <a href="penpalsettings.php"><div data-translate="PenPal Settings"></div></a>
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
                    <span class="name"><div data-translate="Learn More"></div></span>
					<h2><div data-translate="Our contact"></div></h2>
					</div>
            </div>
        </div>
    </div>
</header> 

  <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
				
				<div class="paragraph"><div data-translate="PenPal is a unique language learning web application, that allows German speakers to connect with English speakers, with the objective of enhancing their reading and writing capability through interative learning techniques"></div></div>
				
				<h2><div data-translate="Frequently asked questions"></div></h2>
				<h1>1.</h1>
				<h3><div data-translate="How to complete the Website"></div></h3>
				<div class="paragraph"><div data-translate="Your learning"></div></div>
				<h1>2.</h1>
				<h3><div data-translate="How do I find a PenPal"></div></h3>
				<div class="paragraph"><div data-translate="when you sign up"></div></div>
				<h1>3.</h1>
				<h3><div data-translate="What happens if my penpal leaves me"></div></h3>
				<div class="paragraph"><div data-translate="a new penpal"></div></div>
				<h1>4.</h1>
				<h3><div data-translate="can i learn on my own, without a penpal?"></div></h3>
				<div class="paragraph"><div data-translate="yes you can"></div></div>
				</div>
			</div>	
		</div>		
			
				
 </section>
  
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

</section>
     <script>   
change_lang();
</script>
	</body>
	
	</html>