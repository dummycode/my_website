<?php
    $username = $_GET['username'];
    $code = $_GET['code'];
    echo api_verify($username, $code);

    function api_verify($username, $code)
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "Error connecting to database";
        $query = mysqli_query($con, "SELECT * FROM users WHERE username='" . $username . "'");
        if(mysqli_num_rows($query) !== 1)
            return "user not found";

        $row = mysqli_fetch_array($query);
        if(intval($row["verificationAttempts"]) > 2) {
            return "too many attempts, login to your account to send a new code";
        }

        if(strcmp($row['verified'], 'y') == "0")
            return 'account already verified';
        if(strcmp($row['verificationCode'], $code) == "0")
        {
            $query = mysqli_query($con, "UPDATE users SET verified='y' WHERE username='" . $username . "'");
            $query = mysqli_query($con, "UPDATE users SET verificationCode='verified' WHERE username='" . $username . "'");
            return 'verified';
        }
        #no good
        $query = mysqli_query($con, "UPDATE users SET verificationAttempts='" . (intval($row["verificationAttempts"]) + 1) . "' WHERE username = '" . $username . "';");
        return 'incorrect verification info';
    }
    function api_getNewVerificationCode($token) {
    	include_once($_SERVER['DOCUMENT_ROOT'] . '/api/usermanagement/VerifyToken.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/usermanagement/GetStatusOfAccount.php');
        
        $tokenIsValid = api_verifyToken($token);
        $accountIsActive = api_getStatusViaToken($token);
        
        if($tokenIsValid[0])
        {
        	#valid token, send new code
        	$verificationCode = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
        	$updateUserRow = mysqli_query($con, "UPDATE users SET verificationAttempts='0' AND verificationCode='" . $verificationCode . "' WHERE userID='" . $tokenIsValid[1] . "';");
        	$message = urlencode('Click <a href="http://10.0.1.54:10000/verify.php?username=' . $username . '&code=' . $verificationCode . '">here</a> to verify your Carpool account!');
        exec("php " . $_SERVER['DOCUMENT_ROOT'] . "/api/sendmail.php " . escapeshellarg($email) .  " " . escapeshellarg($message) . " > /dev/null &"); #send an email in the background
        } else {
        	echo ("could not login for reason: " . $tokenIsValid[1]);
        }
    
    
    }
?>