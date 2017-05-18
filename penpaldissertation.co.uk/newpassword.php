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

$email_address = $_SESSION['usernameTemp'];
$checkanswer = $_POST['checkanswer'];
$usernameCookie = $_SESSION["username"];
$passscode = $_SESSION["passcode"];
$emailpasscode = $_POST['emailpasscode'];
$passpasscode = $_POST['passpasscode'];
$newhash = crypt($passpasscode, base64_encode($passpasscode));

$checkforusernameQuery = "SELECT username FROM penpalstore where `username` = '$email_address'";
$replacepassword ="UPDATE penpalstore SET `password` = '$newhash' where `username` = '$email_address'";

if($checkanswer){
$userExists = $conn->query($checkforusernameQuery);
		if($userExists->num_rows > 0){
$conn->query($replacepassword);
    echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/puzzlegame.php\">";
		}else{
		 echo "<script type='text/javascript'>alert('Wrong, didnt change');</script>"; 	
		}

}
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
	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a class="navbar-brand" href="index.html">PenPal!</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="login.php">Login</a>
                    </li>
                    <li class="page-scroll">
                        <a href="register.php">Register</a>
                    </li>
                    <li class="page-scroll">
                        <a href="learnmore.php">Learn More</a>
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
                        
                        <span class="skills">The easy way to learn German online</span>
						
						<hr class="star-light">
                    </div>
                </div>
            </div>
        </div>
<?php if (isset($_SESSION['username'])) : ?>
		<div class="login-page">
		<h1> Change your password here </h1>
		<br>
  <div class="form">
    <form class="loginform" method="post" action="authenticatetest.php">
    <!--  <input type="text" placeholder="Name"onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'"required/> -->
	 <input type="password" name="oldpwd" placeholder="Old Password" id="oldpwd"onfocus="this.placeholder = ''" onblur="this.placeholder = 'Old Password'"required/>
      <input type="password" name="newpwd" placeholder="New Password"  id="pwd"onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'"required/>
	   <input type="password" name="newconfirmpwd" placeholder="Confirm Password" id="newconfirmpwd"onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'"required/>
     
     <button type="submit">Change password</button><br>
      <p class="message"><a href="#">Cancel</a></p>
    </form>
</div>
  </div>
<?php endif; ?>
<?php if (!isset($_SESSION['username']) && (!isset($_SESSION['passcode']) )): ?>
<div class="login-page">
		<h1> Change your password here </h1>
		<br>
		<div class="form">
<h4>We will send you an email regarding your password change </h4>
 <form method="post" action="mail/contact_me.php">
	<input type="email" name="reminder" id="reminder" placeholder="Email "onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'"required/>
     <button type="submit">Send request</button><br>
      
    </form>
	</div>
	</div>
<?php endif; ?>
<?php if (isset($_SESSION['passcode'])) : ?>
<div class="login-page">
		<h1>Enter the passcode here</h1>
		<br>
		<div class="form">
<h4>Be quick, it will expire shortly..  </h4>
 <form method="post" action="newpassword.php">
	<input type="text" name="passcode" id="passcode" placeholder="Passcode "onfocus="this.placeholder = ''" onblur="this.placeholder = 'passcode'"required/>
     <button type="submit">Send Code</button><br>
     
    </form>
	</div>
	</div>
	<?php endif; ?>
	<?php if (isset($_SESSION['passcode']) && $_SESSION['passcode'] === $_POST['passcode']): ?>
		
		<div class="login-page">
		<h1>Enter your desired new password here</h1>
		<br>
		<div class="form">
<h4>think of a good one.. </h4>
 <form method="post" action="newpassword.php">
	<!--<input type="Email" name="emailpasscode" id="emailpasscode" placeholder="Email "onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'"required/> -->
     <input type="password" name="passpasscode" id="passpasscode" placeholder="New Password "onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'"required/>
	<input  type="submit" name="checkanswer" value="Submit Change" />
    
	  
    </form>
	</div>
	</div>
<?php endif; ?>

<script>
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
}); 
</script>
		
		
		
		
		
		
		
    </header>

    

    

   

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

</body>

</html>
