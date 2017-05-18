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
$usernameCookie = $_SESSION["username"];
$getExistingInfoQuery = "SELECT username FROM penpalstore where `username` = '$usernameCookie'";
$deleteFull = "UPDATE `penpalstore` SET `username` = '' where `username` ='$usernameCookie'";


//Select the username of the logged in user
$response = $conn->query($getExistingInfoQuery);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$existingusername = $result["username"];
		
	}
}
		else {
	$existingusername = "";
		}
		
// If user selects delete account, set username value to be blank		
if($DeleteAccount){
	$conn->query($deleteFull);
	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/logout.php\">";
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
                    <span class="name"><div data-translate="Account Settings"></div></span>
					<h2><div data-translate="Our contact"></div></h2>
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
                 <?php if($formdelete) :?>
			
			<form method="post" action="accountsettings.php">
			<div class="6u 12u(mobilep)">
						<h3>Youre about to delete your account permanently , continue?</h3>
			<input type="submit" name="DeleteAccount"  value="Delete" /><input type="submit"  value="Cancel" /> 	
             </div>			
						</form>
						<?php endif;  ?>
           
                    <hr class="star-primary">
						
                </div>
            </div>
			  <div class="col-lg-8 col-lg-offset-2">
			
			<form method="post" action="learnmore.php">
			<div class="6u 12u(mobilep)">
						<h3><div data-translate="Frequently asked questions"></div></h3>
						<input type="submit" name="FAQ"  value="Visit.." />
						</div>
						</form>
			<form method="post" action="newpassword.php">
			<div class="6u 12u(mobilep)">
						<h3><div data-translate="Change your password"></div></h3>
						
						<input type="submit" name="formpassword"  value="Change here" />
						</div>
						</form>
			<form method="post" action="accountsettings.php">
			<div class="6u 12u(mobilep)">
						<h3><div data-translate="No longer need our services?"></div></h3>
						
						<input type="submit" name="formdelete"  value="Delete Account" />
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
                <h2>Contact Us</h2>
				<h3><div data-translate="Please fill"></div></h3>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
               
               
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Phone Number</label>
                            <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Message</label>
                            <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
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