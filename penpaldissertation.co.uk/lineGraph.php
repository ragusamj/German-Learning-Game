<?php
session_start();

if (!isset($_SESSION['username'])) {
 
 echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/login.php\">";
 //header('Location: login.php');
  exit; 
}
?>

<?php

//begins connection
session_start();
 $servername = "localhost";
  $database = "scoutdatabase";
  $dbusername = "markwatt";
  $dbpassword = "Urn9nm8t";
  $table = "timeStamp";
  
 // Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
    $usernameCookie = $_SESSION["username"];
	$PID = $_SESSION["PID"]; 
	$setupPenpal ="SELECT penpalID FROM penpalstore where `username` = '$usernameCookie'";
	$selectConcec = "SELECT `concecDays` from timeStamp where `username`= '$usernameCookie'";
	$getpenpalConcec ="SELECT `concecDays` from timeStamp where `username` = '$PID'";
	$gettimescompletedword = "SELECT `timesCompleted` FROM wordGame where `username` ='$usernameCookie'";
    $gettimescompletedpuzzle = "SELECT `timesCompleted` FROM puzzleGame where `username` ='$usernameCookie'";
    $gettimescompleteddrag = "SELECT `timesCompleted` FROM dragGame where `username` ='$usernameCookie'";
	
	
	$response = $conn->query($selectConcec);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$concec = $result["concecDays"];	
	}
}
		else {
$concec = [""];
		}
		
$response = $conn->query($setupPenpal);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$PID = $result["penpalID"];
		$_SESSION["PID"] = $PID;
	}
}		
		
$response = $conn->query($getpenpalConcec);
if ($response->num_rows > 0){
	if($result = $response->fetch_assoc()){
		$PIDconcec = $result["concecDays"];	
	}
}
		else {
$PIDconcec = [""];
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
<!DOCTYPE HTML>


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
	 <script src="http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
  <link href="http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css" rel="stylesheet" type="text/css" />
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
                    <span class="name"><div data-translate="Statistics"></div></span>
					</div>
            </div>
        </div>
    </div>
</header> 



<body>

<section id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
  
		<h1><div data-translate="see how many concecutive days you have managed this month!"></div><br> </h1>
        
       </div>
     </div>
<div class="ct-chart"  style="border:1px solid #6E6E6E; box-shadow: 0px 0px 5px;  background: #f0f3f5; margin-top:70px; margin-left:auto; margin-right:auto; width:890px; height:375px; padding:15px;  border-radius: 10px 10px 10px 10px;">



 <!-- <p style="font-family: Helvetica; font-size: 130%; color:#585858;">Key: </br>1: DSP 2: n/a 3: n/a 4: n/a 5: n/a </br>6: n/a 7: n/a 8: n/a 9: n/a 10: Example</p>--></div><!--</div>-->
 
 <div>
<!-- Chart.js code used for populating and displaying graph -->
 <?php 
 // sets variables for displaying data to the chart
  global $result;
  global $resultChart;
  global $resultForecast;
  
  //Selects all the data about the current service year and assigns it to variables so they can be converted to javascript
  $mainChart = "SELECT * FROM timeStamp where `username` = '$usernameCookie'";
  $resultChart = $conn->query($mainChart);
  
  $point1 = null;
  $point2 = null;
  $point3 = null;
  $point4 = null;
  $point5 = null;
 
  $trackdate = null;
  
  
  $currentDateEvening = "2016-04-14";
  $currentDateMorning = "2016-04-15";
  if ($resultChart->num_rows > 0){
  while($row = $resultChart->fetch_assoc()) {
		
		$date = $row["date"];
		$date2 = strrev($date);
		$date3 = reset(array_filter(preg_split("/[-]/",$date2)));
		$date4 = strrev($date3);
		
		
		//calculate how many days ago
	
			
			//populate graph 
			
			if (isset($_SESSION['username'])){			
     
		if($date4==32){
			$point1=$row["concecDays"];
			
		}
		if($date4==32){
			$point2=$row["concecDays"];
			
		}
		if($date4==1||$date4==2||$date4==3||$date4==4||$date4==5||$date4==6||$date4==7||$date4==8||$date4==9||$date4==10||$date4==11||$date4==12||$date4==13||$date4==14||$date4==15||$date4==16||$date4==17||$date4==18||$date4==19||$date4==20||$date4==21||$date4==22||$date4==23||$date4==24||$date4==25||$date4==26||$date4==27||$date4==28||$date4==29||$date4==30||$date4==31){
			$point3=$row["concecDays"];
			   
		}
		if($date4==32){
			$point4=$row["concecDays"];
			
		}
		if($date4==32){
			$point5=$row["concecDays"];
			
		
			}
		
    }
}
  }

//$getTotal = "SELECT concecDays FROM Yokos ORDER BY date AND time DESC LIMIT 1";
$getTotal = "SELECT concecDays FROM timeStamp where `username` = '$usernameCookie' ORDER BY date DESC LIMIT 1";
$total = $conn->query($getTotal);

while($total2 = $total->fetch_assoc()){
			$total3 = $total2["concecDays"];
	      }
   
   
   //date4,date streak at  - how many days streak

			$trackdate = $date4 - $total3;
			
			

//closes connection to the database
$conn->close(); 
 ?> 
 <br><br>
 <h3> Your Current Streak is <?php echo $total3; ?> days! </h3>
 <br><br>
   <div class="col-lg-8 col-lg-offset-2">
 <form method="post" action="accountsettings.php">
			<div class="6u 12u(mobilep)">
						<h3><div data-translate="Youre currently at Completion level"></div> <input type="text"  style="width:2em;" value="<?php if($completedenoughword === null){ echo '0'; }else { echo $completedenoughword; } ?>" readonly /><div data-translate="in the word game"></div></h3>
						<h3><div data-translate="Youre currently at Completion level"></div><input type="text" style="width:2em;" value="<?php if($completedenoughpuzzle === null){ echo '0'; }else { echo $completedenoughpuzzle; } ?>" readonly /><div data-translate="in the puzzle game"></div></h3>
						<h3><div data-translate="Youre currently at Completion level"></div><input type="text" style="width:2em;" value="<?php if($completedenoughdrag === null){ echo '0'; }else { echo $completedenoughdrag; } ?>" readonly /><div data-translate="in the Drag game"></div></h3>
						<h4><div data-translate="Remember"></div></h4>
						<input type="submit" name="formsubmit"  value="Take the test!" />
						</div>
						</form>
	        </div>
			
 <div class="col-lg-12 text-center">
 <br><br><br>
 <h2> Your Awards cabinet! </h2>
    <hr class="star-primary">
 </div>
 <div class="row">
                     <?php if($concec >= '5')   : ?>
                <div class="col-sm-4 portfolio-item">
                    <a class="portfolio-link" > 
                        <div class="caption">
                            <div class="caption-content">
							<h4 style="color:red;"> You achieved a bronze 5 day streak! </h4>
                             <!--   <i class="fa fa-search-plus fa-3x"></i> -->
                            </div>
                        </div>
                        <img src="img/portfolio/bronze.png" class="img-responsive" alt="">
                    </a>
                </div>
				<?php endif; ?>
				<?php if($concec >= '10')   : ?>
                <div class="col-sm-4 portfolio-item">
                    <a class="portfolio-link" >
                        <div class="caption">
                            <div class="caption-content">
                             <h4 style="color:red;">You achieved a silver level 10 day streak! </h4>
                            </div>
                        </div>
                        <img src="img/portfolio/10daystreak.png" class="img-responsive" alt="">
                    </a>
                </div>
				<?php endif; ?>
				<?php if($concec >= '20')   : ?>
                <div class="col-sm-4 portfolio-item">
                    <a class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                              <h4 style="color:red;"> You achieved a gold level 20 day streak! </h4>
                            </div>
                        </div>
                        <img src="img/portfolio/20daystreak.png" class="img-responsive" alt="">
                    </a>
                </div>
				<?php endif; ?>
				<?php if(isset($_SESSION['PID']) && $PIDconcec >= '5')   : ?>
                <div class="col-sm-4 portfolio-item">
                    <a class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                             <h4 style="color:red;"> The motivator! you encouraged your penpal to reach 5 day streak </h4>
                            </div>
						</div>
                        <img src="img/portfolio/motivator.png" class="img-responsive" alt="">
                    </a>
                </div>
				<?php endif; ?>
				<?php if($concec >= '30')   : ?>
                <div class="col-sm-4 portfolio-item">
                    <a class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                            <h4 style="color:red;"> You achieved a diamond level 30 day streak!</h4>
                            </div>
                        </div>
                        <img src="img/portfolio/30daystreak.png" class="img-responsive" alt="">
                    </a>
                </div>
				<?php endif; ?>
				<?php if(isset($_SESSION['PID']) && $PIDconcec >= '10')   : ?>
                <div class="col-sm-4 portfolio-item">
                    <a class="portfolio-link">
                        <div class="caption">
                            <div class="caption-content">
                        <h4 style="color:red;"> Your penpal reached 10 concecutive days, champion!</h4>
                            </div>
                        </div>
                        <img src="img/portfolio/champion.png" class="img-responsive" alt="">
                    </a>
                </div>
				<?php endif; ?>
				
				<?php if(!isset($_SESSION["PID"]) && $concec <= '4' )   : ?>
                 <div class="col-lg-12 text-center">
                    <a class="portfolio-link">
                      <h1 style="color:red;"> You currently have no trophies, complete challenges to earn them! </h1>
                        <img src="" class="img-responsive" alt="">
                    </a>
                </div>
				<?php endif; ?>
				<?php if($concec <= '4' && $PIDconcec <='4' )   : ?>
                 <div class="col-lg-12 text-center">
                    <a class="portfolio-link">
                      <h1 style="color:red;"> You currently have no trophies, complete challenges to earn them! </h1>
                        <img src="" class="img-responsive" alt="">
                    </a>
                </div>
				<?php endif; ?>
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
</div>   

</footer>
 <script>
 
 /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function notificationFunction() {
    document.getElementById("notificationDropdown").classList.toggle("show");
}

function dropdownFunction() {
    document.getElementById("Dropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var d = 0; d < dropdowns.length; d++) {
      var openDropdown = dropdowns[d];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
//assigns the data taken from the database in php and assigns them to javascript variables.
//the variables are then printed out into a chart for the user to see.

var point1 = "<?php echo $point1; ?>";
var point2= "<?php echo $point2; ?>";
var point3 = "<?php echo $point3; ?>";
var point4 = "<?php echo $point4; ?>";
var point5 = "<?php echo $point5; ?>";



new Chartist.Line('.ct-chart', {
  labels: ['This Month'],
  series: [
    [point1,point2,point3,point4,point5], 
  ]
}, {
  fullWidth: true,fullHeight:true
});
</script>
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