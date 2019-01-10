<?php

	#make into function
	
	$username = $_GET["username"];
	
	$con = connectToDatabase();
    if($con == false)
        echo "error connecting to database";
     
	
	
	$verificationCode = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
	$message = urlencode('Click <a href="http://10.0.1.54:10000/verify.php?username=' . $username . '&code=' . $verificationCode . '">here</a> to verify your Carpool account!');
        exec("php " . $_SERVER['DOCUMENT_ROOT'] . "/api/sendmail.php " . escapeshellarg($email) .  " " . escapeshellarg($message) . " > /dev/null &"); #send an email in the background
   
    #update database
    include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/GetIDFromUsername.php');
    $query = mysqli_query($con, "UPDATE users SET verificationCode='" . $verificationCode . "' WHERE id='" . api_getIDFromUsername($username) . "';");
    $query = mysqli_query($con, "UPDATE users SET verificationAttempts='0' WHERE id='" . api_getIDFromUsername($username) . "';");
    
    echo "email sent"; #done
    
?>