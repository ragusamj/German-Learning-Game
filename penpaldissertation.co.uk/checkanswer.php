
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
$existingEnglishWord = $_SESSION['English'];
$existingGermanWord = $_SESSION['German'];
$usernameCookie = $_SESSION["username"];
$getExistingInfoQuery2 ="SELECT `English` , `German` FROM wordDictionary where `ID` = '1' ORDER BY RAND() LIMIT 1";
$getGermanWord = "SELECT `German` FROM wordDictionary where `German` = '$existingGermanWord'";
$updatestage = "UPDATE `progressTrack` SET `saveStage` = `saveStage` + 1 where `username` ='$usernameCookie'";
$updatestandard = "UPDATE `progressTrack` SET `standardLevel` = `standardLevel` + 1 where `username` ='$usernameCookie'";
$updatestagepuzzle ="UPDATE `puzzleGame` SET `saveStage` = `saveStage` + 1, `correctAnswer` = `correctAnswer` + 1 where `username` ='$usernameCookie'";
$updatestagepuzzlewrong ="UPDATE `puzzleGame` SET `saveStage` = `saveStage` + 1 where `username` ='$usernameCookie'";
$updatestageword ="UPDATE `wordGame` SET `saveStage` = `saveStage` + 1, `correctAnswer` = `correctAnswer` + 1 where `username` ='$usernameCookie'";
$updatestagewordwrong ="UPDATE `wordGame` SET `saveStage` = `saveStage` + 1 where `username` ='$usernameCookie'";


//Code for checking answer to  puzzle game in german
    if (isset($_SESSION['German']) && isset($_POST['guesspuzzle']) && $_SESSION['German'] == $_POST['guesspuzzle']){
        $conn->query($updatestagepuzzle);
        $_SESSION['correct'] = 'correct';
	    echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/puzzlegame.php\">";
    }
	else if(isset($_SESSION['German']) && isset($_POST['guesspuzzle']) && $_SESSION['German'] != $_POST['guesspuzzle']){
	       $conn->query($updatestagepuzzlewrong);
		 	$_SESSION['wrong'] = 'wrong';
	       echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/puzzlegame.php\">";
	}
//Code for checking answert to puzzle in English
	 else if (isset($_SESSION['English']) && isset($_POST['guesspuzzlegerman']) && $_SESSION['English'] == $_POST['guesspuzzlegerman']){
        $conn->query($updatestagepuzzle);
		
        $_SESSION['correct'] = 'correct';
	    echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/puzzlegame.php\">";
    }
	else if(isset($_SESSION['English']) && isset($_POST['guesspuzzlegerman']) && $_SESSION['English'] != $_POST['guesspuzzlegerman']){
	       $conn->query($updatestagepuzzlewrong);
		 	$_SESSION['wrong'] = 'wrong';
	       echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/puzzlegame.php\">";
	}
//Code to check answers to leveltest in German		 
    else if (isset($_SESSION['German']) && isset($_POST['guess']) && $_SESSION['German'] == $_POST['guess']){
	      $conn->query($updatestage);
	      $conn->query($updatestandard);
	            echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/leveltest.php\">";
    }
    else if(isset($_SESSION['German']) && isset($_POST['guess']) && $_SESSION['German'] != $_POST['guess']){
	    $conn->query($updatestage);
	 
	    echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/leveltest.php\">";
	}
//Code to check answers to leveltest in English
	else if (isset($_SESSION['English']) && isset($_POST['guessgerman']) && $_SESSION['English'] == $_POST['guessgerman']){
	     $conn->query($updatestage);
	     $conn->query($updatestandard);
	     echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/leveltest.php\">";
    }
    else if(isset($_SESSION['English']) && isset($_POST['guessgerman']) && $_SESSION['English'] != $_POST['guessgerman']){
	    $conn->query($updatestage); 
	    echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/leveltest.php\">";
//Code for checking wordgame answer	in German   
	}
    else if (isset($_SESSION['German']) && isset($_POST['guessword']) && $_SESSION['German'] == $_POST['guessword']){
	    $conn->query($updatestageword);
		$_SESSION['correct'] = 'correct';
	    echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/wordgame.php\">";
    }
    else if(isset($_SESSION['German']) && isset($_POST['guessword']) && $_SESSION['German'] != $_POST['guessword']){
	    $conn->query($updatestagewordwrong);
		$_SESSION['wrong'] = 'wrong';
		echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/wordgame.php\">";
	}
//Code for checking wordgame answer	in English
	 else if (isset($_SESSION['English']) && isset($_POST['guesswordgerman']) && $_SESSION['English'] == $_POST['guesswordgerman']){
	    $conn->query($updatestageword);
		
		$_SESSION['correct'] = 'correct';
	    echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/wordgame.php\">";
    }
    else if(isset($_SESSION['English']) && isset($_POST['guesswordgerman']) && $_SESSION['English'] != $_POST['guesswordgerman']){
	    $conn->query($updatestagewordwrong);
		 
		$_SESSION['wrong'] = 'wrong';
		echo "<meta http-equiv=\"refresh\" content=\"0;http://www.penpaldissertation.co.uk/wordgame.php\">";
	}



?>