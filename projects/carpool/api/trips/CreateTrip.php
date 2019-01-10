<?php
   
   if(isset($_GET["api"]))
    {
    	$token = $_GET["token"];
    	$date = $_GET["date"];
    	$time = $_GET["time"];
    	$start = $_GET["start"];
    	$end = $_GET["end"];
    	
    	#clear all get variables for future calls
        foreach($_GET as $key => $value)
		{
			$_GET[$key] = '';
		}
        echo api_createtrip($token, $date, $time, $start, $end);
    }
   
   function api_createtrip($token, $date, $time, $start, $end)
    {
        
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/usermanagement/VerifyToken.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/usermanagement/GetStatusOfAccount.php');
 
        $tokenIsValid = api_verifyToken($token);
        $accountIsActive = api_getStatusViaToken($token);
        
        #$accountIsActiveParts = explode('\,', $accountIsActive);
        
        #need to also verify status of account at this point as well
        if($tokenIsValid[0] && strcmp($accountIsActive[0], "active") == "0" && strcmp($accountIsActive[1], "y") == "0")
        {
            //verify all variables
            $dateParts = explode("/", $date);
            if(!checkdate(intval($dateParts[0]), intval($dateParts[1]), intval($dateParts[2])))
            	return "invalid date";
            $userDate = new DateTime($date);
			$now = new DateTime();
            if($userDate <= $now)
                return "you must create a trip a day in advance";
                
                
            //get starting geocodes
            $start = preg_replace("/ /", "+", $start);
            $convertAddressToCoordsJSONURL = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $start . "key=AIzaSyBN8dksMgAINNBUL01fpWK8MaW_cYIw4Fk";
            $convertAddressToCoordsJSON = @file_get_contents($convertAddressToCoordsJSONURL);
            $jsonContent = json_decode($convertAddressToCoordsJSON, true);
            $startLat = $jsonContent['results'][0]['geometry']['location']['lat'];
            $startLng = $jsonContent['results'][0]['geometry']['location']['lng'];
            //get ending geocodes
            $end = preg_replace("/ /", "+", $end);
            $convertAddressToCoordsJSONURL = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $end . "&key=AIzaSyBN8dksMgAINNBUL01fpWK8MaW_cYIw4Fk";
            $convertAddressToCoordsJSON = @file_get_contents($convertAddressToCoordsJSONURL);
            $jsonContent = json_decode($convertAddressToCoordsJSON, true);
            $endLat = $jsonContent['results'][0]['geometry']['location']['lat'];
            $endLng = $jsonContent['results'][0]['geometry']['location']['lng'];
            
            #include_once($_SERVER["DOCUMENT_ROOT"] . 'api/trips/GetDistanceBetween.php');
            #$distance = apiGetDistanceBetween($start, $end);

            #sql
            include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
            $con = connectToDatabase();
            if($con == false)
                return "error connecting to database";

            mysqli_query($con, "INSERT INTO trips (`id`, `userid`, `date`, `time`, `startingLatitude`, `startingLongitude`, `startingAddress`, `endingLatitude`, `endingLongitude`, `endingAddress`, `distance`) VALUES (NULL, '1', '" . $date . "', '" . $time . "', '" . $startLat . "', '" . $startLng . "', '" . $start . "','" . $endLat . "','" . $endLng . "','" . $end . "','" . $distance . "')");
            return "trip from " . $startLat . "," . $startLng . " to " . $endLat . "," . $endLng . " on " . $date . " at " . $time . " created";

        }
        else {
        	if(strcmp($tokenIsValid[1], "invalid") == "0")
            	return "invalid token";
            else if(strcmp($accountIsActiveParts[0], "active") != "0")
            	return "you are " . $accountIsActiveParts[0];
            else if(strcmp($accountIsActiveParts[1], "y") != "0")
            	return "please verify your account before creating a trip";
            else 
            	return "unknown error with your account";
        }
    }
?>
