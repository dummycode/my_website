<?php
	if($_GET["username"] && $_GET["code"]) {
	
		$username = $_GET["username"];
		$code = $_GET["code"];
		
		#clear all get variables for future calls
        foreach($_GET as $key => $value)
        {
            $_GET[$key] = '';
        }
        
        $goodToReset[][] = verifyResetCode($username, $code);
        if($goodToReset[0]) {
        	echo "resetting password for id=" . $goodToReset[1];
        } else {
        	echo $goodToReset[1];
        }
	}
	else {
		echo 'invalid arguments';
	}
	
	function verifyResetCode($username, $code) {
		include_once($_SERVER["DOCUMENT_ROOT"] . '/api/ConnectToDatabase.php');
		$con = connectToDatabase();
		$userID = api_getIDFromUsername($username);
		
		if($con == false)
			return array(0, "error connecting to database");
		else {
			include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/GetIDFromUsername.php');
			$query = mysqli_query($con, "SELECT * FROM resets WHERE user_id='" . $userID . "';");
			
			if(mysqli_num_rows($query) == 0) {
				return array(0, "no reset code found for specified user");
			}
			else if(mysqli_num_rows($query) != 1) {
				return array(1, "we out this bitch, database returned something strange");
			}
			else {
				#verify code
				$row = mysqli_fetch_array($query);
				if(intval($row['attempts']) > 2)
					return array(0, "you've tried that too much, you cannot reset your password for another " . time() - $row["expiration"] . "minute(s)");
				else if(strcmp($row["code"], $code) == "0") {
					#good to go
					return array(1, $userID);
				}
				else {
					#invalid code
					$query = mysqli_query($con, "UPDATE resets SET attempts='" . ($intval($row['attempts']) + 1) . "' WHERE user_id='" . $userID . "';");
					return array(0, "invalid code, only " . (3 - ($intval($row['attempts']) + 1)) . " attempts remain");
				} 
			}
		}
	}	
?>