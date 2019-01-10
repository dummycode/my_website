<?php

	#get variables
	$tripID1 = $_GET['tripID1']; //inner trip?
	$tripID2 = $_GET['tripID2']; //outter trip?
	
	#get token to run data
	$token = $_GET['token'];
	
	#clear all get variables for future calls
    foreach($_GET as $key => $value)
	{
		$_GET[$key] = '';
	}
	
	echo apiCalculateOutOfWay($tripID1, $tripID2, $token);
	
	#function: returns double with distance "out of way" in miles and duration "out of way" in seconds sperated by '\,'
	function apiCalculateOutOfWay($tripID1, $tripID2, $token) {
	
		#include file to check token validity
		include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/VerifyToken.php');
		$tokenIsValid = api_verifyToken($token);
		#if statement to check validity
		if(!$tokenIsValid[0])
        	return 'could not verify token: ' . $tokenIsValid[1];
        else {
        	#run the function
        	
        	#update last used
        	include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/UpdateTokenLastUsed.php');
			apiUpdateTokenLastUsed($token);
        	
        	#connect to database
        	include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
        	$con = connectToDatabase();
        	if($con == false)
            	return "error connecting to database";
            	
        	#get start and end addresses
        	$query1 = mysqli_query($con, "SELECT * FROM trips WHERE id='" . $tripID1 . "';");
        	if(mysqli_num_rows($query1) == 0)
            	return "trip one not found";
            else if(mysqli_num_rows($query1) != 1)
            	return "error with query";
            else {
            	$row = mysqli_fetch_array($query1);
        		$tripStart1 = $row['startingAddress'];
        		$tripEnd1 = $row['endingAddress'];
        		
        		#distance form start to end
        		include_once($_SERVER["DOCUMENT_ROOT"]	. '/api/trips/GetDistanceBetween.php');
				#get parts and seperate
        		$originalArray = apiGetDistanceBetween($tripStart1, $tripEnd1);
        		$originalParts = explode('\,', $originalArray);
        		$originalDistance = $originalParts[0];
        		$originalDuration = $originalParts[1];
        	}
        	
        	#echo ($originalDistance . "," . $originalDuration . "<br>");
        	
        	#get start and end addresses
        	$query2 = mysqli_query($con, "SELECT * FROM trips WHERE id='" . $tripID2 . "';");
        	if(mysqli_num_rows($query2) == 0)
            	return "trip two not found";
            else if(mysqli_num_rows($query2) != 1)
            	return "error with query";
            else {
            	$row = mysqli_fetch_array($query2);
        		$tripStart2 = $row['startingAddress'];
        		$tripEnd2 = $row['endingAddress'];
        		#distance form start to end with waypoints
        		include_once($_SERVER["DOCUMENT_ROOT"]	. '/api/trips/GetDistanceBetween.php');
        		#get parts and seperate
        		$newArray = apiGetDistanceBetweenWithWaypoints($tripStart1, $tripEnd1, $tripStart2, $tripEnd2);
        		$newParts = explode('\,', $newArray);
        		$newDistance = $newParts[0];
        		$newDuration = $newParts[1];
        	}
        	
        	#calculate distance and duration out of way
        	$distanceOutOfWay = $newDistance - $originalDistance;
        	$durationOutOfWay = $newDuration - $originalDuration;
        	
        	return ($distanceOutOfWay . '\,' . $durationOutOfWay);
        }
	}
?>