<?php
    if(isset($_POST['login']))
        login($_POST['username'], $_POST['password']);
    else if(isset($_POST['createuser']))
        createuser($_POST['name'], $_POST['birthmonth'] . "/" . $_POST['birthday'] . "/" . $_POST['birthyear'], $_POST['username'], $_POST['password'], $_POST['email']);
    else if(isset($_POST['logout']))
        logout();
    else
    {
        if(isset($_COOKIE['token']))
        {
            include_once($_SERVER['DOCUMENT_ROOT'] . '/projects/carpool' . '/api/ConnectToDatabase.php');
            $con = ConnectToDatabase();
            if($con == false)
            {
                setcookie("token", "", time - 3600);
                notLoggedIn("error connecting to database, logged out<br>", "");
            }
            else
            {
            	include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/VerifyToken.php');
            	$tokenStatus = api_verifyToken($_COOKIE['token']);
            	#if token is invalid
            	if(!$tokenStatus[0])
            	{
            		if(strcmp($tokenStatus[1], "user with token does not exists, deleting all tokens") == "0") {
            			setcookie("token", "", time() - 3600);
                    	notLoggedIn("user with specified token has been deleted<br>", "");
            		}
            		else if(strcmp($tokenStatus[1], "invalid") == "0") {
            			setcookie("token", "", time() - 3600);
                    	notLoggedIn("invalid token<br>", "");
                    }
                    else {
                    	setcookie("token", "", time() - 3600);
                    	notLoggedIn($tokenStatus[1], "");
                    }
            	}
            	#good to go
            	else
            	{
            		include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/GetStatusOfAccount.php');
            		#verify if user has been activated
            		$userStatus = api_getStatusViaID($tokenStatus[1]);
            		#$userStatusParts = explode('\,', $userStatus);
            		if(strcmp($userStatus[1], "n") == "0")
            			echo "Please verify your account!<br>";

            		#get account username from id
            		include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/GetUsernameFromID.php');
            		loggedIn(api_getUsernameFromID($tokenStatus[1])); #token status should be the user id, returns user name
            	}
            }
        }
        else
            notLoggedIn("", "");
    }
    function logout()
    {
        destroysession();
        echo 'Logged out!';
    }
    function destroysession()
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/projects/carpool' . '/api/ConnectToDatabase.php');
        $con = ConnectToDatabase();
        if($con == false)
        {
            setcookie("token", "", time - 3600);
            return;
        }
        $query = mysqli_query($con, "DELETE FROM sessions WHERE token='" . $_COOKIE['token'] . "'");
        setcookie("token", "", time() - 3600);
    }
    function loggedIn($username)
    {
        echo 'logged in as ' . $username . '<br>
        <form action="" method="POST" name="logout">
	    <input type="submit" name="logout" value="Logout">
	    </form>';
    }
    function notLoggedIn($resultLogin, $resultCreateuser)
    {
        echo 'Carpool - Copyright Dummy Code &copy<br><br>';
        echo 'Login<br>';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/projects/carpool' . '/gui/loginform.html');
        echo 'Sign Up<br>';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/projects/carpool' . '/gui/createuserform.html');
    }
    function createuser($name, $birthday, $username, $password, $email)
    {
        include_once("./api/createuser.php");
        $result = api_createuser($name, $birthday, $username, $password, $email);
        if(strcmp($result, $username . " created!") == "0")
            login($username, $password);
        else
            notLoggedIn("", $result . '<br>');
    }
    function login($username, $password)
    {
        include_once("./api/login.php");
        $result = api_login($username, $password);
        if(strlen($result) == 128)
        {
            setcookie("token", $result);
            header('Location: '. $_SERVER['REQUEST_URI']);
        }
        else if(strcmp($result, "user not found") == "0" || strcmp($result, "incorrect password") == "0")
        {
            notLoggedIn($result . "<br>", "");
        }
        else if(strcmp($result, "banned") == "0")
            notLoggedIn("This account has been banned<br>", "");
        else if(strcmp($result, "Error connecting to database") == "0")
            notLoggedIn($result . "<br>", "");
        else
            echo "Unknown error: " . $result;
    }
?>
