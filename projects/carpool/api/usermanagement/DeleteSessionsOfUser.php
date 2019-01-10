<?php
    #if api
    if(strcmp($_GET['api'], "false") == "0")
    {
        $_GET['api'] = '';
        echo api_deleteSessionsOfUser($_GET["username"]);
    }
    function api_deleteSessionsOfUser($username) {
        include_once($_SERVER["DOCUMENT_ROOT"] . '/api/usermanagement/GetIDFromUsername.php');
        $userid = api_GetIDFromUsername($username);
        if(strcmp($userid, "user not found") == "0")
            return;
        include_once($_SERVER["DOCUMENT_ROOT"] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "error connecting to database";
        $query = mysqli_query($con, "DELETE FROM sessions where user_id='" . $userid . "';");
        return "terminated " . (mysqli_affected_rows($con)) . " session(s)";
    }
?>
