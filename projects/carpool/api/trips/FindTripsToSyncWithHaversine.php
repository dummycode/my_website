<?php
	$api = $_GET["api"];
	$id = $_GET["id"];
	#clear all get variables for future calls
    foreach($_GET as $key => $value)
	{
		$_GET[$key] = '';
	}
	if(strcmp($api, "false") == "0")
		echo apiFindTripsToSyncWith($id);
		

	/*
	* uses an algorithm to find trips to sync with
	*/
	function apiFindTripsToSyncWith($tripID) {
	
		include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
		$con = connectToDatabase();
		if($con == false)
			return "error connecting to database";
		else { #continue as normal
			$query = mysqli_query($con, "SELECT * FROM trips WHERE id='" . $tripID . "';");
			if(mysqli_num_rows($query) == 0)
				return "error: query not found";
			else if (mysqli_num_rows($query) !== 1)
				return "error: database returned something strange";
			else { #continue as normal
			 	$row = mysqli_fetch_array($query);
			 	
			 	/*
			 	* get values for formula
			 	*/
			 	$distance = $row['distance'];
			 	
			 	$y1 = $row['startingLatitude'];
			 	$x1 = $row['startingLongitude'];
			 	
				$y2 = $row['endingLatitude'];
				$x2 = $row['endingLongitude'];
				
				$deltaX = $x2 - $x1;
				$deltaY = $y2 - $y1;
				
				$angle = tan($deltaY/$deltaX);
				
				$h = ($x2 + $x1)/2;
				$k = ($y2 + $y1)/2;
				$l = sqrt(pow(($x2 - $x1), 2) + pow(($y2 - $y1), 2)); #get hypotenuse
				
				$slope = (($y2 - $y1)/($x2 - $x1));
				
				
				
				echo 'slope: ' . $slope . '<br>';
				
				echo 'angle: ' . $angle . '<br>';
				
				echo ("l = " . $l . "<br>
				h = " . $h . ",
				k = " . $k . "<br>");
				
				$r1 = ($l * 1.25);
				$r2 = ($l * 0.25);
				
				echo ('r1=' . $r1 . '<br>r2=' . $r2 . '<br>');
				
				$query = ("SELECT * FROM 
				(SELECT *, (
				(((((startingLongitude - " . $h . ") * cos(" . $angle . ")) + ((startingLatitude - " . $k . ") * sin(" . $angle . "))) * (((startingLongitude - " . $h . ") * cos(" . $angle . ")) + ((startingLatitude - " . $k . ") * sin(" . $angle . "))))/" . pow($r1, 2) . ")
				+ 
				(((((startingLongitude - " . $h . ") * sin(" . $angle . ")) - ((startingLatitude - " . $k . ") * cos(" . $angle . "))) * (((startingLongitude - " . $h . ") * sin(" . $angle . ")) - ((startingLatitude - " . $k . ") * cos(" . $angle . "))))/" . pow($r2, 2) . "))
				
				AS point2 FROM 
				(SELECT *, (
				(((((endingLongitude - " . $h . ") * cos(" . $angle . ")) + ((endingLatitude - " . $k . ") * sin(" . $angle . "))) * (((endingLongitude - " . $h . ") * cos(" . $angle . ")) + ((endingLatitude - " . $k . ") * sin(" . $angle . "))))/" . pow($r1, 2) . ")
				+ 
				(((((endingLongitude - " . $h . ") * sin(" . $angle . ")) - ((endingLatitude - " . $k . ") * cos(" . $angle . "))) * (((endingLongitude - " . $h . ") * sin(" . $angle . ")) - ((endingLatitude - " . $k . ") * cos(" . $angle . "))))/" . pow($r2, 2) . "))
				
				AS point1 FROM 
				(SELECT * FROM trips WHERE distance >= " . ($distance * .25) . ") as query1)
				 as query2) as query3 WHERE point1 <= 1 AND point2 <= 1 LIMIT 0 , 10;");
				
			#perform query
			$result = mysqli_query($con, $query);
			echo 'whole query: ' . $query;
			if (!$result) {
    			$message  = 'invalid query: ' . mysqli_error() . "\n";
    			$message .= 'whole query: ' . $query;
    			die($message);
			}
				if(mysqli_num_rows($result) == 0)
					return "no trips found";
				else {
					$counter = 0;
					$response = '';
					while($row = mysqli_fetch_array($result))
        			{
            			if($counter === 0)
                			$response = $row['id'];
            			else
                			$response .= ', ' . $row['id'];
            			$counter = $counter + 1;
        			}
        			return $response;
        		}
			}
		}
	
	}
?>