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

$myLang = $_SESSION['mylang'];
$lookingforpartner = $_SESSION['listuser']; 
$listselect= $_POST['listselect'];
$theAdder = $_SESSION['theAdder'];
$searchedname= $_SESSION['founduser'];
$accept = $_POST['accept'];
$formsubmit = $_POST['formsubmit'];
$searchagain = $_POST['searchagain'];
$searchpost = $_POST['search'];
$submit = $_POST['submit'];
$usernameCookie = $_SESSION["username"];
$getExistingInfoQuery = "SELECT `username`, `nativeLang` FROM penpalstore where `username` = '$usernameCookie'";
$getavailablepenpals = "SELECT DISTINCT `username` FROM penpalstore where `penpalID` = '' AND `penpalID` != '$usernameCookie' AND `nativeLang` != '$myLang' ORDER BY RAND() LIMIT 20";
$getinfo ="SELECT * FROM penpalstore WHERE `username` LIKE '%$searchpost%'";
$addpal = "UPDATE `penpalstore` SET `penpalID` = '$searchedname' WHERE `penpalID` ='' AND `username` = '$usernameCookie'";
$addpallist = "UPDATE `penpalstore` SET `penpalID` = '$lookingforpartner' WHERE `penpalID` ='' AND `username` = '$usernameCookie'";
$checkifrequestmade = "SELECT `username` from penpalstore WHERE `penpalID` = '$usernameCookie'";
$acceptrequest = "UPDATE `penpalstore` SET `penpalID` = '$theAdder' where `username` = '$usernameCookie'";
$declinerequest = "UPDATE penpalstore SET penpalID = '' WHERE `username` = '$theAdder'";





if($listselect){
	
$myemail = 'support@penpal.co.uk';
$email_address = $_SESSION['listuser'];


 if(isset($_SESSION['listuser'])){
	
	
$to = $email_address;
    $email_subject = "Penpal Connection Request";
    $email_body = "The following user would like to be your new Penpal!: {$usernameCookie}'\n
    Please login to view and accept this request!".
	"All of your Penpal settings can be reached at the Penpal Settings page, located on your main dashboard".
	
    //    "Email: $email_address";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    //redirect to the 'thank you' page
  //  header('Location: youneedtoactivate.php');
	echo "<script type='text/javascript'>alert('Success! user added');</script>";
}
$conn->query($addpallist);
 echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/penpalsettings.php\">";
}	
	
	


if($submit){
	
	if (isset ($_POST['search'] )){
		
		
		$response= $conn->query($getinfo);
		if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$searchedname = $result["username"];
		$_SESSION['founduser'] = $searchedname;
		//echo "<script type='text/javascript'>alert('success');</script>";
		
	}
		}
		else {
	$searchedname = "";
echo "<script type='text/javascript'>alert('Username not found, try again!');</script>";
		}
		
		
		//echo "<script type='text/javascript'>alert('success');</script>";
		
	}	else if(!isset ($_POST['search'] )){
		
	 echo "<script type='text/javascript'>alert('Wrong sdfgnext level');</script>";
	
}else {
	 echo "<script type='text/javascript'>alert('error');</script>";
}
}

if($searchagain){
	
	unset($_SESSION["founduser"]);
	unset($_SESSION["theAdder"]);
	$conn->query($declinerequest);
	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/newpenpal.php\">";
	
}

if($formsubmit){
$myemail = 'support@penpal.co.uk';
$email_address = $_SESSION['founduser'];


 if(isset($_SESSION['founduser'])){
	
	
$to = $email_address;
    $email_subject = "Penpal Connection Request";
    $email_body = "The following user would like to be your new Penpal!/ Der folgende Benutzer möchte sich mit Ihnen verbinden!: {$usernameCookie}'\n
    Please login to view and accept this request!/ Bitte loggen Sie sich ein, um diese Anfrage zu sehen und zu akzeptieren '\n
	All of your Penpal settings can be reached at the Penpal Settings page, located on your main dashboard '\n
	Alle Ihre Brieffreund-Einstellungen können auf der Seite PenPal Einstellungen auf deinem Haupt-Armaturenbrett erreicht werden".
    //    "Email: $email_address";
	
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    //redirect to the 'thank you' page
  //  header('Location: youneedtoactivate.php');
	
}
$conn->query($addpal);
 echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/penpalsettings.php\">";
}

if($accept){
	
	$conn->query($acceptrequest);
	echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/penpalsettings.php\">";
}

$response = $conn->query($getExistingInfoQuery);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$existingusername = $result["username"];
        $myLang = $result["nativeLang"];
			$_SESSION['mylang'] = $myLang;
	}
}
		else {
	$existingusername = "";
  $myLang = "";
		}
		
$response = $conn->query($getavailablepenpals);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$lookingforpartner = $result["username"];
		$_SESSION['listuser'] = $lookingforpartner;
	}
}
		else {
	$lookingforpartner = "";

		}		
		
$response = $conn->query($checkifrequestmade);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		
		$theAdder = $result["username"];
		$_SESSION['theAdder'] = $theAdder;
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
                    <span class="name"><div data-translate="Choose a study companion from the following list!"></div></span>
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
                    <h2><div data-translate="For more information"></div></h2>
                    <hr class="star-primary">
						
                </div>
            </div>
			<div class="row">
			
			<?php if(!isset ($_SESSION['founduser'])  && $theAdder === null) : ?>
			<div class="col-sm-5 portfolio-item">
			<h3><div data-translate="Want to search for someone specific?"></div></h3>
			<form method="POST" action="newpenpal.php">
			<input type="text" name="search" />
            <input type="submit" name="submit"  value="Find User" />
	        </form>
	        </div>
				<?php endif; ?>
				
				
				
				<?php if(isset ($_SESSION['founduser'])) : ?>
				<div class="col-sm-5 portfolio-item">
			<h3> The user <?php echo $_SESSION['founduser'] ?> <div data-translate="has been found, would you like to send a request?"></div> </h3>
			<form method="POST" action="newpenpal.php">
				<input type="submit" name="formsubmit"  value="Yes" />
				<input type="submit" name="searchagain"  value="Search Again" />
				</form>
				</div>
			<?php endif; ?>
			
			
				<?php if($theAdder !== null) : ?>
				<div class="col-sm-5 portfolio-item">
			<h3> The user <?php echo $theAdder ?><div data-translate="has added you, would you like to accept?"></div> </h3>
			<form method="POST" action="newpenpal.php">
				<input type="submit" name="accept"  value="Yes" />
				<input type="submit" name="searchagain"  value="No" />
				</div>
			<?php endif; ?>
			
			
			
			<?php if($theAdder === null) : ?>
			<div class="col-sm-4 portfolio-item">
			<h3><div data-translate="Here is an available partner!"></div> </h3>
			<?php echo $lookingforpartner ?>
			<form method="post" action ="newpenpal.php">
			<input type="submit" name="listselect" value="select this user"  />
			</form>
			</div>
			<?php endif; ?>
			
			
			
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

     <script>   
change_lang();
</script>
	</body>
	
	</html>