<?php
    if(strcmp($_GET['api'], "false") == "0")
    {
        echo api_showuser($_GET['id']);
    }
    function api_showuser($id)
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "Error connecting to database";
        $query = mysqli_query($con, "SELECT * FROM users WHERE id='" . $id ."'");
        if(mysqli_num_rows($query) == 0)
            return "user with id " . $id . " not found";
        $row = mysqli_fetch_array($query);
        print_r($row);
        return;
    }
?>
