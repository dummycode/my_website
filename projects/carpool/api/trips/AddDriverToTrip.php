<?php
    #must be api therefore ignore all other calls
    echo 'ignored';

    function api_addDriverToTrip($tripID, $userID) {
        
        #verify user
        include_once($_SERVER["DOCUMENT_ROOT"] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        $verifyUserQuery = mysqli_query($con, "SELECT * FROM users WHERE id='" . $userID . "';");
        
        if(mysqli_num_rows($verifyUserQuery) == 0)
            return "user not found";
        
        else if(mysqli_num_rows($verifyUserQuery) != 1)
            return "database returned something strange...";
        
        else
        {
            #good to go
            
            #verify trip
        }
    
    }
?>
