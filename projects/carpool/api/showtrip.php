<?php
    if(strcmp($_GET['api'], "false") == "0")
    {
        echo api_showtrip($_GET['id']);
    }

    #returns info about a trip
    function api_showtrip($id)
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "Error connecting to database";

        $query = mysqli_query($con, "SELECT * FROM trips WHERE id='" . $id ."'");
        if(mysqli_num_rows($query) == 0)
            return "trip with id " . $id . " not found";
        $row = mysqli_fetch_array($query);
        print_r($row);
        return;
    }
?>
