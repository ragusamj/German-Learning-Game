
<?php
session_start();

if (!isset($_SESSION['username'])) {
 
 echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/index.php\">";
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
date_default_timezone_set('Europe/London');
$datetoday = (date('Y-m-d'));
$lastlogin = $_SESSION["lastlogin"];
$usernameCookie = $_SESSION["username"];
$getExistingInfoQuery = "SELECT username FROM penpalstore where `username` = '$usernameCookie'";
$firstlogin ="SELECT username FROM progressTrack where `username` = '$usernameCookie'";
$dateCheck = "SELECT date FROM timeStamp where `username` = '$usernameCookie'";
$insertDate= "UPDATE timeStamp SET `date` ='$datetoday' where `username` = '$usernameCookie'";
$addconcec = "UPDATE timeStamp SET `concecDays` = `concecDays` +1 where `username` = '$usernameCookie'"; 
$getPercentage = "SELECT percentComplete FROM `progressTrack` where `username` = '$usernameCookie'";
$inserttimestamp = "INSERT INTO timeStamp (`username`, `date`) VALUES ('$usernameCookie', '$datetoday')";
$removeconcec = "UPDATE timeStamp SET `concecDays` = '0' where `username` = '$usernameCookie'";

$response = $conn->query($getExistingInfoQuery);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$existingusername = $result["username"];
	}
}
		else {
$existingusername = [""];

		}
		
$result = $conn->query($firstlogin);
if ($result->num_rows == 0){
	
		$conn->query($inserttimestamp);
		echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/leveltest.php\">";
	}

$response = $conn->query($dateCheck);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$lastlogin = $result["date"];
		$_SESSION["lastlogin"] = $lastlogin;  
		
	}
}
		else {
$lastlogin = [""];
		}
$response = $conn->query($getPercentage);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$Percent = $result["percentComplete"];
		
		
	}
}
	
	
if($_SESSION['lastlogin'] !== date('Y-m-d')){
			
		
if($_SESSION['lastlogin'] === date('Y-m-d',strtotime("-1 day"))){
	 echo date('Y.m.d');
	 $conn->query($addconcec);
	 $conn->query($insertDate);
	//  echo "<script type='text/javascript'>alert('well done on another day');</script>";
} else if ($_SESSION['lastlogin'] !== date('Y-m-d',strtotime("-1 day"))){
	$conn->query($removeconcec);
	 $conn->query($insertDate);
	
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
                    <a href="penpalsettings.php"><div data-translate="PenPal Settings"></div></a>
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
                    <span class="name"><div data-translate="Your Dashboard"></div></span>

                  

                </div>
            </div>
        </div>
    </div>
</header> 

 <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><div data-translate="Welcome"></div> <?php echo $usernameCookie; ?> </h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="wordgame.php" class="portfolio-link"  > 
                        <div class="caption">
                            <div class="caption-content">
							
							<h1 style="color:red;"><div data-translate="Simple Word Game"></div> </h1>
                             <!--   <i class="fa fa-search-plus fa-3x"></i> -->
                            </div>
                        </div>
                        <img src="img/portfolio/game1.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="puzzlegame.php" class="portfolio-link" >
                        <div class="caption">
                            <div class="caption-content">
                             <h1 style="color:red;"><div data-translate="Puzzle Game"></div> </h1>
                            </div>
                        </div>
                        <img src="img/portfolio/game2.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="draggame.php" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                              <h1 style="color:red;"><div data-translate="Drag game"></div> </h1>
                            </div>
                        </div>
                        <img src="img/portfolio/game3.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="leveltest.php" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                            <h1 style="color:red;"><div data-translate="Take the test!"></div></h1>
                            </div>
                        </div>
                        <img src="img/portfolio/test.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="lineGraph.php" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                             <h1 style="color:red;"><div data-translate="Check your progress"></div></h1>
                            </div>
							
                        </div>
                        <img src="img/portfolio/chart.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="penpalsettings.php" class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                        <h1 style="color:red;"><div data-translate ="Communicate with your PenPal!"></div> </h1>
                            </div>
                        </div>
                        <img src="img/portfolio/PID.png" class="img-responsive" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

<!-- About Section -->
<section class="success" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><div data-translate="Your progress"></div></h2>
				<h3><div data-translate="When you reach 100%"></div></h3>
                <br>
            </div>
        </div>
         <div class="container">
            <div class="row">
                <div class="footer-col col-md-4">
               <h1>  <?php echo $Percent; ?>% <div data-translate="COMPLETED!"></div></h1>
                </div>
                <div class="footer-col col-md-4">
                 
				</div>
            </div>
        </div>
	</div>
</section>

<!-- Contact Section -->


<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4">
                   
                </div>
                <div class="footer-col col-md-4">
                    
                    
                </div>
                
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                   Thanks to Bootstrap web templates for the layout design. Thomas Portch 2017
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>



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