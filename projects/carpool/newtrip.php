<?php
    if(isset($_COOKIE['token'])) {
		include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/VerifyToken.php');
        $tokenStatus = api_verifyToken($_COOKIE['token']);
        #if token is invalid
        if($tokenStatus[0]) {
        	include_once($_SERVER['DOCUMENT_ROOT'] . '/api/usermanagement/GetStatusOfAccount.php');
        	$verification = api_getStatusViaToken($_COOKIE['token']);
        	if(strcmp($verification[1], "y") == "0") {
        		#verify user has not been banned
        		if(strcmp($verification[0], "banned") == "0")
        			echo 'your account has been banned';
        		#verify other statuses here	
        	} else {
            		echo 'please verify your account before creating a trip';
            }	
			if(isset($_POST['newtrip'])){
				newtrip();
            } else {
            	showform();
				#good to go
			}
        } else {
			echo 'token is not valid: ' . $tokenIsValid[1];
		}
    } else {
        echo 'you must be logged in to create a trip';
    }
    
    function newtrip()
    {
        $startLocation = $_POST['start'];
        $endLocation = $_POST['end'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        if($startLocation && $endLocation)
        {
            include_once($_SERVER['DOCUMENT_ROOT'] . '/api/trips/CreateTrip.php');
            echo api_CreateTrip($_COOKIE['token'], $date, $time, $startLocation, $endLocation);
        }
        else
            echo 'bad values';
    }
    function showform()
    {
        //include_once('./gui/newtripform.html'); //changed for testing locally, should be the following line
        include_once($_SERVER['DOCUMENT_ROOT'] . '/gui/newtripform.html');
    }
?>
