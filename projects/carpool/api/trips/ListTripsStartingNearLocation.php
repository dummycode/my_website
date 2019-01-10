<?php
    if(strcmp($_GET['api'], "false") == "0")
    {
        $locationLatitude = $_GET['lat'];
        $locationLongitude = $_GET['long'];
        
        $token = $_GET['token']; #for data collection and verification
        
        #clear all get variables for future calls
        foreach($_GET as $key => $value)
		{
			$_GET[$key] = '';
		}
		
		#verify token and run data
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/usermanagement/VerifyToken.php');
        $tokenIsValid = api_VerifyToken($token);
        if(!$tokenIsValid[0])
        	echo 'could not verify token' . $tokenIsValid[1];
        else {
        	echo "searching with user id=" . $tokenIsValid[1] . "<br><br>";
        	echo apiListTripsStartingNearLocation($locationLatitude, $locationLongitude);
        }
        
    }
    function apiListTripsStartingNearLocation($locationLatitude, $locationLongitude)
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "Error connecting to database";
            
        #validate coordinates
        if(abs($locationLatitude) >= 90 || abs($locationLongitude) >= 180)
        	return "invalid coordinates";
            
        #convert degrees to radians
        $latRad = deg2rad($locationLatitude);
        $longRad = deg2Rad($locationLongitude);

		//search all queries within 1 latitudinal degree

        $tripsNearLocation = mysqli_query($con, "SELECT * FROM (SELECT *, ( 3959 * acos( cos(" . $latRad . ") * cos( radians( startingLatitude ) ) * cos( radians( startingLongitude ) - (" . $longRad . ") ) + sin(" . $latRad . ") * sin( radians( startingLatitude ) ) ) ) AS distance FROM (SELECT * FROM trips_test WHERE startingLatitude BETWEEN " . ($locationLatitude - 1) . " AND " . ($locationLatitude + 1) . ") as query1) as query2 WHERE distance < 10 ORDER BY distance LIMIT 0 , 10;");
        
        if(mysqli_num_rows($tripsNearLocation) == 0)
            return "no trips starting near specified location, create one today";
            
       	$counter = 0;
       	$result = '';
        while($row = mysqli_fetch_array($tripsNearLocation))
        {
            if($counter === 0)
                $result = $row['id'] . " starting " . $row['distance'] . " miles away on " . $row['date'];
            else
                $result .= ',' . $row['id'] .  " starting " . $row['distance'] . " miles away on " . $row['date'];
            $counter = $counter + 1;
        }
        echo $result;
    }
?>
