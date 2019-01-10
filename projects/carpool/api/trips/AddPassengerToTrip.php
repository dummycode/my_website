<?php
	if(strcmp($_GET["api"], "false") == "0")
		echo api_addPassengerToTrip($_GET["tripID"], $_GET["passengerID"]);
		
	function api_addPassengerToTrip($tripID, $passengerID) {
		include_once($_SERVER["DOCUMENT_ROOT"] . '/api/ConnectToDatabase.php');
		$con = connectToDatabase();
		if($con == false)
			return "error connecting to database";
		#good to go
		else {
		
			#verify user
			$query = mysqli_query($con, "SELECT * FROM users WHERE id='" . $passengerID . "';");
			if(mysqli_num_rows($query) == 0)
				return "user not found";
			else if(mysqli_num_rows($query) > 1) 
				return "database returned something weird...";
			
			$query = mysqli_query($con, "SELECT * FROM trips WHERE id='" . $tripID . "';");
			if(mysqli_num_rows($query) == 0)
				return "trip not found";
			#good to go
			else if(mysqli_num_rows($query) == 1) {
				$row = mysqli_fetch_array($query);
				$passengers = explode(',', $row['passenger']);
				
				if(sizeof($passengers) >= intval($row['maxPassengers']))
					return "already maximum passengers for this trip";
				else {
					#verify if user is already in passengers
					for($i = 0; $i < sizeof($passengers); $i++) {
						if(strcmp($passengers[$i], $passengerID) == "0")
							return "passenger already joined trip";
					}
					#good to add to passenger
					$newPassengers = '';
					if(strcmp($row['passenger'], 'none') == "0" || !$row['passenger'])
						$newPassengers = $passengerID;
					else {
						$row['passenger'] .= ',' . $passengerID; #add passenger
						$newPassengers = $row['passenger'];
					}
					$query = mysqli_query($con, "UPDATE trips SET passenger='" . $newPassengers . "' WHERE id='" . $tripID . "';"); 
					return "passenger added";
				}
			}
			else {
				#should never happen but handle anyway
				return "the database returned something weird...";
			}
		}
	}
?>