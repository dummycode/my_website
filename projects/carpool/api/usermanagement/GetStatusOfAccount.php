<?php
	
    #returns status of account if it is banned, verified or such 
	if(isset($_GET["api"])) 
	{
	
        if($_GET["token"])
			api_getStatusViaToken($_GET["token"]);
		else if($_GET["userID"])
			api_getStatusViaID($_GET["userID"]);
		else
			echo 'invalid arguments';
	
    }
	
    function api_getStatusViaToken($token)
	{
		include_once($_SERVER['DOCUMENT_ROOT'] . '/api/usermanagement/VerifyToken.php');
        $tokenIsValid = api_verifyToken($token);
        if(!$tokenIsValid[0])
        	return "could not verify token: " . $tokenIsValid[1];
        #returns user id so check via id now
        return api_getStatusViaID($tokenIsValid[1]);
	}

	function api_getStatusViaID($userID)
	{
		include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
		$con = connectToDatabase();
		$query = mysqli_query($con, "SELECT * FROM users WHERE id='" . $userID . "';");
		if(mysqli_num_rows($query) != 1)
			return "user not found"; 
		$row = mysqli_fetch_array($query);
		return array($row['status'],  $row['verified']);
		
		#return $row['status'] . "\," . $row['verified'];
		#returns active, banned, suspended, or other statuses in the future
	}
?>
