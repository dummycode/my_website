<?php
    if(strcmp($_GET['api'], "false") == "0") {
        $_GET['api'] = '';
        echo api_getIDFromUsername($_GET["username"]);
    }

    function api_getIDFromUsername($username) {
        include_once($_SERVER["DOCUMENT_ROOT"] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "error connecting to database";
        $query = mysqli_query($con, "SELECT * FROM users WHERE username='" . $username . "';");
        if(mysqli_num_rows($query) == 0)
            return "user not found";
        $row = mysqli_fetch_array($query);
        return $row['id'];
    }
?>