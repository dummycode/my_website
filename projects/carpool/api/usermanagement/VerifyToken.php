<?php
    #if not api
    if(isset($_GET["api"]))
        echo api_verifyToken($_GET["token"]);
    
    function api_verifyToken($token) {
        #sql
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return array(false, "error connecting to database");

        $token_exists = mysqli_query($con, "SELECT * FROM sessions WHERE token='" . $token . "';");
        if(mysqli_num_rows($token_exists) == 1)
        {
        	$row = mysqli_fetch_array($token_exists);
        	$userID = $row['user_id'];
            #verify if user still exists
            $user_exists = mysqli_query($con, "SELECT * FROM users WHERE id='" . $userID . "';");
            if(mysqli_num_rows($user_exists) == 1)
            	return array(true, $userID); #return all good
            else {
            	#clean up tokens
            	$deleteAllTokensWithID = mysqli_query($con, "DELETE FROM sessions WHERE user_id='" . $userID . "';");
            	return array(false, "user with token does not exists, deleting all tokens");
            }
        }
        else
            return array(false, "invalid");
    }
?>
