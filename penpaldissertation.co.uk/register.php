

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
                        <a href="#page-top"></a>
                    </li>
                   <li class="page-scroll">
                    <a href="index.php">Home</a>
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
                    </div>
					<h2><div data-translate="Enter your details here!"></div></h2>
                </div>
            </div>
        </div>

		<div class="login-page">
    <div class="form">
    

	<form class="register-form" method="post" action="authenticatetest.php">
	<input type="email" name="username" id="username" placeholder="Username"onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'"required/>
      <input type="password" name="pwd" id="pwd" placeholder="Password"onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'"required/>
       <button type="submit">Login</button><br>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
	    <p class="message">Forgotten your Password? <a href="newpassword.php">Change it here</a></p>
    </form>
	<form class="login-form" method="post" action="authenticatetest.php">
    <!--  <input type="text" placeholder="Name"onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'"required/> -->
	 <input type="email" name="username" placeholder="Email address"onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'"required/>
      <input type="password" name="pwd" placeholder="Password"onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'"required/>
	   <input type="password" name="confirmpwd" placeholder="Confirm Password"onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'"required/>
    <!-- <input type="text" name="nativeL" placeholder="Native Language"onfocus="this.placeholder = ''" onblur="this.placeholder = 'Native Language'"required/>-->
	
  <input type="radio" name="nativeL" value="English" checked><h3 style="color:black;"> English</h3><br>
  <input type="radio" name="nativeL" value="German"> <h3 style="color:black;">German</h3><br>

	<button type="submit">Create</button><br>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    </div>
    </div>

    <script>
    $('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    }); 
    </script>
		
		
		
		
		
		
		
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    
                    <br>
                </div>
            </div> 
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
                <p>This product is being designed as part of my major project for Aberystyth University. Any work is my own doing</p>
            </div>
            <div class="col-lg-4">
                <p>If you would like to get in contact with me to discuss anything about this product, please use the contact form on the home page and I will respond as soon as possible</p>
            </div>
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <a href="" class="btn btn-lg btn-outline">
                    <i class="fa fa-download"></i> Return to the top
                </a>
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
