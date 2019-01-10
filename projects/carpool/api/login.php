<?php
    if(isset($_GET['api']))
    {
        $usernameOrEmail = strtolower($_GET['account']);
        $password = stripslashes($_GET['password']);
        
        echo api_login($usernameOrEmail, $password);
    }

    function api_login($usernameOrEmail, $password)
    {
    		#connect to database
            include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
            $con = connectToDatabase();
            if($con == false)
                return "error connecting to database";
                
            #if username
            $query = mysqli_query($con, "SELECT * FROM users WHERE username='" . $usernameOrEmail . "'");
            if(mysqli_num_rows($query) == 1)
                return api_verifyPassword($query, $password);
            
            #if email
            $query = mysqli_query($con, "SELECT * FROM users WHERE email='" . $usernameOrEmail . "'");
            if(mysqli_num_rows($query) == 1)
                return api_verifyPassword($query, $password);
            
            #if none of the above return user not found
            return "user not found";
    }
    
    /*
    * Returns a token 128 characters in length
    */
    function api_getToken()
    {
        $characters = '01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $token = "";
        for($i = 0; $i < 128; $i++)
            $token .= $characters[mt_rand(0,61)];
        return $token;
    }
    function api_verifyPassword($query, $password)
    {
        $row = mysqli_fetch_array($query);
        
        #if password matches
        if(strcmp($row['password'], hash('md5', $password)) == "0")
        {
            #if(strcmp($row['status'], "active") !== 0)
            #   return $row['status'];
            
            $user_id = $row['id'];
            $token = '';
            
            #connect to database
            include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
            $con = connectToDatabase();
            if($con == false)
                return "error connecting to database";
            
            #get a unique token
            do
            {
                $token = api_getToken();
            } while(mysqli_num_rows(mysqli_query($con, "SELECT * FROM sessions WHERE token='" . $token . "'")) !== 0); #verify that the token is unique

            $query = mysqli_query($con, "INSERT INTO sessions (`user_id`, `token`, `expiration`, `lastused`) VALUES ('" . $user_id . "', '" . $token . "', NOW() + INTERVAL 1 DAY, NOW())"); #insert new token
            return $token;
        }
        
        return "incorrect password";
    }
?>
