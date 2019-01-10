<?php
	$api = $_GET["api"];
	$id = $_GET["id"];
	#clear all get variables for future calls
    foreach($_GET as $key => $value)
	{
		$_GET[$key] = '';
	}
	if(strcmp($api, "false") == "0")
		echo apiFindTripsToSyncWithStartAndEnd($id);
		
	function apiFindTripsToSyncWithStartAndEnd($id) {
		
		#connect to database
		include_once($_SERVER["DOCUMENT_ROOT"] . '/api/ConnectToDatabase.php');
		$con = connectToDatabase();
		if($con == false)
			return array(0, 'failed to connect to database');
		
		#get start and end location
		$query = mysqli_query($con, "SELECT * FROM trips WHERE id='" . $id . "';");
		if(mysqli_num_rows($query) == 0)
			return array(0, 'query not found');
		else if (mysqli_num_rows($query) !== 1)
			return array(0, 'database returned something strange');
		else { #continue as normal
			$row = mysqli_fetch_array($query);
			$startAdd = $row['startingAddress'];
			$endAdd = $row['endingAddress'];
			
			
		/* 
		* broken: need to modify longRad and latRad to be the parsed trip's start location
		* note: must duplicate distance calculation to account for start and stop
		*/	
		$tripsNearLocation = mysqli_query($con, "SELECT * FROM (SELECT *, ( 3959 * acos( cos(" . $latRad . ") * cos( radians( startingLatitude ) ) * cos( radians( startingLongitude ) - (" . $longRad . ") ) + sin(" . $latRad . ") * sin( radians( startingLatitude ) ) ) ) AS distance FROM (SELECT * FROM trips_test WHERE startingLatitude BETWEEN " . ($row['startingLatitude'] - 1) . " AND " . ($row['startingLatitude'] + 1) . " AND " . ($row['startingLongitude'] - 1) . " AND " . ($row['startingLongitude'] + 1) . ") as query1) as query2 WHERE distance < 10 ORDER BY distance LIMIT 0 , 10;");
		}
		
		if(mysqli_num_rows($tripsNearLocation) == 0)
            return "no trips matching specified trip, create one today";
            
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