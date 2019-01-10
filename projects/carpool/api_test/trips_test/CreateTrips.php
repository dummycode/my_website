<?php
	echo 'creating trips...';
	
	#connect to the database
	include_once($_SERVER["DOCUMENT_ROOT"] . '/api/ConnectToDatabase.php');
		$con = connectToDatabase();
	if($con == false)
        return "Error connecting to database";
            
	for($i = 0; $i < 10000; $i++) {
		$lat = mt_rand(-90, 90);
		$long = mt_rand(-180, 180);
		$distance = mt_rand(0, 1000);
		
		$query = mysqli_query($con, "INSERT INTO trips_test (`id`, `userid`, `date`, `time`, `startingLatitude`, `startingLongitude`, `startingAddress`, `endingLatitude`, `endingLongitude`, `endingAddress`, `maxPassengers`, `passenger`, `driver`, `distance`) VALUES (NULL, '0', '1/1/99', '12:00', '" . $lat . "', '" . $long . "', 'sAddress', '" . $lat . "', '" . $long . "', 'eAddress', '0', '0', '0','" . $distance . "');");
		 
	}
			if (!$query) {
    			$message  = 'invalid query: ' . mysqli_error() . "\n";
    			$message .= 'whole query: ' . $query;
    			die($message);
			}
	echo 'done.';
?>