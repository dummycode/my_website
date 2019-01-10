<?php
	if(strcmp($_GET["api"], "false") == "0") {
		$add1 = $_GET["add1"];
		$add2 = $_GET["add2"];
		
		//clear get variables
		foreach($_GET as $key => $value)
		{
			$_GET[$key] = '';
		}
		$returnArray = apiGetDistanceBetween($add1, $add2);
		
		echo $returnArray[0] . '<br>' . $returnArray[1];
	}
	//else do nothing
	 
	#function: returns array of distance between two addresses and time of travel 
	function apiGetDistanceBetween($add1, $add2) {
		#replace spaces with plus signs
		$add1 = preg_replace("/ /", "+", $add1);
		$add2 = preg_replace("/ /", "+", $add2);
        $calculateDistanceJSONURL = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $add1 . "&destination=" . $add2 . "&sensor=false";
        $calculateDistanceJSON = @file_get_contents($calculateDistanceJSONURL);
        $jsonContent = json_decode($calculateDistanceJSON, true);
        $distance = $jsonContent['routes'][0]['legs'][0]['distance']['value'];
        $duration = $jsonContent['routes'][0]['legs'][0]['duration']['value']; #duration in seconds
        $distance = (($distance/1000) * 0.621371); #convert m to mi
        return array($distance, $duration);
        #return $distance . '\,' . $duration;
	}
	#function: returns array of distance between two addresses and time of travel
	function apiGetDistanceBetweenWithWaypoints($add1, $add2, $waypoint1, $waypoint2) {
		#replace spaces with plus signs
		$add1 = preg_replace("/ /", "+", $add1);
		$add2 = preg_replace("/ /", "+", $add2);
		$waypoint1 = preg_replace("/ /", "+", $waypoint1);
		$waypoint2 = preg_replace("/ /", "+", $waypoint2);
		
        $calculateDistanceJSONURL = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $add1 . "&destination=" . $add2 . "&waypoints=" . $waypoint1 . "|" . $waypoint2 . "&sensor=false";
        #echo $calculateDistanceJSONURL;
        $calculateDistanceJSON = @file_get_contents($calculateDistanceJSONURL);
        $jsonContent = json_decode($calculateDistanceJSON, true);
        
        #add all the legs together 
        $totalDistance = 0;
        $totalTime = 0;
        for($i = 0; $i < count($jsonContent['routes'][0]['legs']); $i++) {
        	$totalDistance = $totalDistance + $jsonContent['routes'][0]['legs'][$i]['distance']['value'];
        	$totalTime = $totalTime + $jsonContent['routes'][0]['legs'][$i]['duration']['value']; #duration in seconds
        }
        
        $totalDistance = (($totalDistance/1000) * 0.621371); #convert from meters to miles
        
        #echo $jsonContent['routes'][0]['legs'][0]['distance']['text'];
        #echo $jsonContent['routes'][0]['legs'][0]['duration']['value']; #duration in seconds
        #echo ($totalDistance . '\,' . $totalTime . "<br>") ;
        return array($totalDistance, $totalTime);
        #return $totalDistance . '\,' . $totalTime;
	}
?> 