<?php

	/*
	* is not accessible via public api therefore there is no get variables needed
	*/
	
	#function: returns good or bad and updates last used for token inputted
	function apiUpdateTokenLastUsed($token) {
		#connect to database
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "error connecting to database";
            
        #include file to check token validity
        /*
        * shouldn't need to check validity but we'll do it anyway
        */
		include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/VerifyToken.php');
		$tokenIsValid = api_verifyToken($token);
		#if statement to check validity
		if(!$tokenIsValid[0])
        	return "invalid token";
        	
        else {
        	#run query to update lastUsed
        	/*
        	* may update expiration in future depending on the way we handle that
        	*/
        	$query = mysqli_query($con, "UPDATE trips SET lastUsed= NOW() WHERE token='" . $token . "';");
        	return "updated lastUsed";
        }
	}

?>