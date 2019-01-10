<?php
    #if not api
    if(isset($_GET['api']))
    {
    	#retrieve all passed get variables
        $name = $_GET['name'];
        $birthday = $_GET['birthday'];
        $username = strtolower($_GET['username']);
        $password = $_GET['password'];
        $email = $_GET['email'];
    
        #clear all get variables for future calls
        foreach($_GET as $key => $value)
		{
			$_GET[$key] = '';
		}
        echo api_createuser($name, $birthday, $username, $password, $email); 
        
    }

    function api_createuser($name, $birthday, $username, $password, $email)
    {
        $username_length = strlen($username);
        $password_length = strlen($password);

        #verifications of passed variables
        if($username_length < 4 || $username_length > 20)
            return "username must be 4-20 characters long";
            
        if(preg_match('/[^A-Za-z0-9]/', $username))
            return "username can only contain letters and numbers";
            
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            return "invalid email";
            
        if($password_length < 6)
            return "password must be longer than 6 characters";
            
        #also need to verify birthday here

        #sql
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "error connecting to database";

		#check to see if user already exists in database
        $username_exists = mysqli_query($con, "SELECT * FROM users WHERE username='" . $username . "'") or die(mysqli_error());
        if(mysqli_num_rows($username_exists) != 0)
            return "user already exists";
            
        #check to see if email already exists in database
        $email_exists = mysqli_query($con, "SELECT * FROM users WHERE email='" . $email . "'") or die(mysqli_error());
        if(mysqli_num_rows($email_exists) != 0)
            return "there is already an account accosiated with that email, please login or request a new password";

        #create user
        $verificationCode = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
        mysqli_query($con, "INSERT INTO users (`id`, `name`, `birthday`, `username`, `password`, `email`, `verified`, `verificationCode`, `verificationAttempts`, `rating`, `driverCount`, `passengerCount`, `status`) VALUES (NULL, '". $name . "', '" . $birthday . "', '" . $username . "', '" . hash('md5', $password) . "', '" . $email . "', 'n', '" . $verificationCode . "', '0', '-1', '0', '0', 'active')") or die(mysqli_error());
        
        $message = urlencode('Click <a href="http://10.0.1.54:10000/verify.php?username=' . $username . '&code=' . $verificationCode . '">here</a> to verify your Carpool account!');
        exec("php " . $_SERVER['DOCUMENT_ROOT'] . "/api/sendmail.php " . escapeshellarg($email) .  " " . escapeshellarg($message) . " > /dev/null &"); #send an email in the background
        
        mysqli_close($con);
        
        return $username . " created!"; #return good
        
    }
?>
