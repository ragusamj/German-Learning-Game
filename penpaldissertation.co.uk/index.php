<?php include
session_start();
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

$usernameCookie = $_SESSION["username"];
$passscode = $_SESSION["passcode"];


?>
<!DOCTYPE html>


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

    <!-- Custom Fonts -->
     <script type="text/javascript" src="js/translate.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
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
            <a class="navbar-brand" href="home.php">PenPal!</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="login.php"><div data-translate="Login"></div></a>
                </li>
                <li class="page-scroll">
                    <a href="register.php"><div data-translate="Register"></div></a>
                </li>
                <li class="page-scroll">
                    <a href="learnmore.php"><div data-translate="Learn More"></div></a>
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
                <img class="img-responsive" src="img/hallologo.png" alt="">
                <div class="intro-text">
                    <span class="name">PenPal!</span>
					
                    <span class="skills"><div data-translate="The easy"></div></span>

                    <hr class="star-light">
					
					
		<!-- login options -->
		
		
		
		
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
                <h2><div data-translate="Why you"></div></h2>
                <h3><div data-translate="Research has"></div></h3>
                <br>
            </div>
        </div>
        <section class="box special features">
            <div class="features-row">
                <section>
                    <img src="img/research.png" alt="">
                    <h3><div data-translate="RESEARCH"></div></h3>
					<div class="paragraph"><div data-translate="There is"></div></div>
                </section>
                <section>
                    <img src="img/fastsmall.png" alt="">
                    <h3><div data-translate="Learn"></div></h3>
                     <div class="paragraph"><div data-translate="Using the help"></div></div>
                </section>
            </div>
            <div class="features-row">
               <section>
                    <img src="img/devices.png" alt="">
                    <h3><div data-translate="Cross device compatibility"></div></h3>
                    <div class="paragraph"><div data-translate="PenPal has"></div></div>
                </section>
				<section>
                    <img src="img/globe.png" alt="">
                    <h3><div data-translate="Use PenPal on the move!"></div></h3>
                  <div class="paragraph"><div data-translate="Because PenPal"></div></div>
                </section>
            </div>
        </section>

    </div>
</section>

<!-- About Section -->
<section class="success" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>About</h2>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2">
               <div class="paragraph"><div data-translate="This product"></div></div>
            </div>
            <div class="col-lg-4">
                <div class="paragraph"><div data-translate="If you would"></div></div>
            </div>
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <a href="" class="btn btn-lg btn-outline">
                    <i class="fa fa-download"></i> Return to the top
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Contact Me </h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
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
</section>

<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                	<div class="col-lg-12 text-center">
                    <h3>Location</h3>
                    <p>Aberystyth University
                        <br>Wales</p>
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