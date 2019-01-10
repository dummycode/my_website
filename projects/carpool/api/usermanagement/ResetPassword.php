<?php
	#if not api
	if(strcmp($_GET["api"], "false") == "0")
	{
		if($_GET["resetCode"])
			echo api_verifyResetCode($_GET["resetCode"]);
		else if($_GET["userID"] && $_GET["newPassword"])
			echo api_changePassword($_GET["userID"], $_GET["newPassword"]);
		else if($_GET["usernameOrEmail"])
			echo api_sendResetLink($_GET["usernameOrEmail"]);
		else
			echo 'pass a variable';
	}
	#else do nothing

	function api_sendResetLink($usernameOrEmail)
	{
		include_once($_SERVER["DOCUMENT_ROOT"] . "api/ConnectToDatabase.php");
		$connection = connectToDatabase();
		if($connection == false)
			return 'error connecting to database';
		else
		{
			$query = mysqli_query($connection, "SELECT * FROM users WHERE username='" . $usernameOrEmail . "' OR email='" . $usernameOrEmail . "';");
			if(mysqli_num_rows($query) == 1)
			{
				#send them an email with a reset code
				$row = mysqli_fetch_array($query);
				$userID = $row['id'];
				$email = $row['email'];
				#create reset code
				do
            	{
                	$resetCode = api_getResetCode();
            	} while(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM resets WHERE code='" . $resetCode . "'")) !== 0);


            	$query = mysqli_query($connection, "INSERT INTO resets (`user_id`, `code`, `expiration`) VALUES ('" . $userID . "', '" . $resetCode . "', NOW() + INTERVAL 1 HOUR);"); #insert, code expires in 1 hour

				$message = urlencode('You have requested to reset your password! Click <a href="http://10.0.1.54:10000/api/resetpassword.php?resetCode=' . $resetCode .  '&api=false">here</a> to reset your password!');
				exec("php " . $_SERVER['DOCUMENT_ROOT'] . "/api/sendmail.php " . escapeshellarg($email) .  " " . escapeshellarg($message) . " > /dev/null &");
				return 'good';
			}
			else if(mysqli_num_rows($query) == 0)
				return 'no user found with email or username ' . $usernameOrEmail;
			else
				return 'mysql returned something weird...';
		}
	}
	function api_changePassword($userID, $newPassword)
	{
		include_once($_SERVER['DOCUMENT_ROOT'] . 'api/ConnectToDatabase.php');
		$connection = connectToDatabase();
		if($connection == false)
			return 'error connecting to database';
		else
		{
			$query = mysqli_query($connection, "UPDATE users SET password='" . hash('md5', $newPassword) . "' WHERE id='" . $userID . "';");
			return 'password changed';
		}
	}
	function api_verifyResetCode($resetCode)
	{
		#ifGood return good
		include_once($_SERVER['DOCUMENT_ROOT'] . 'api/ConnectToDatabase.php');
		$connection = connectToDatabase();
		$query = mysqli_query($connection, "SELECT * FROM resets WHERE code='" . $resetCode . "';");
		if(mysqli_num_rows($query) == 1) {
			#also return user id associated with code
			return 'good';
		}
		else {
			return 'invalid reset code';
		}
	}
	function api_getResetCode()
    {
        $characters = '01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $code = "";
        for($i = 0; $i < 24; $i++)
            $code .= $characters[mt_rand(0,61)];
        return $code;
    }
?>
