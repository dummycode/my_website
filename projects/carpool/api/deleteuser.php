<?php
    #if not api
    if(strcmp($_GET['api'], "false") == "0")
    {
    	#get username and password to delete user
        $username = strtolower($_GET['username']);
        $password = stripslashes($_GET['password']);
        
        #clear all get variables for future calls
        foreach($_GET as $key => $value)
		{
			$_GET[$key] = '';
		}
        echo api_deleteUser($username, $password);
    }

    function api_deleteUser($username, $password)
    {
    	#connect to database
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "error connecting to database";
            
        $query = mysqli_query($con, "SELECT * FROM users WHERE username='" . $username. "'"); #see if user exists, should never fail
        if(mysqli_num_rows($query) == 0)
            return "user not found";
        
        $row = mysqli_fetch_array($query);
        if(strcmp($row['password'], hash('md5', $password)) == '0') #if password matches
        {
            include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/DeleteSessionsOfUser.php');
            $deleteSessions = api_deleteSessionsOfUser($username);
            $query = mysqli_query($con, "DELETE FROM users WHERE username='" . $username . "'"); #delete here
            return "user deleted";
        }
        
        mysqli_close($con); #close sql connection
        return "incorrect password";
    }
?>
