<?php
    if(strcmp($_GET["api"], "false") == "0")
        echo api_viewprofile($_GET["id"], $_GET["api"]);
    function api_viewprofile($id, $api) {
        include_once($_SERVER["DOCUMENT_ROOT"] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "error connecting to database";
        $query = mysqli_query($con, "SELECT * FROM users where ID='" . $id . "'");
        if(mysqli_num_rows($query) == 0)
            return "user not found";
        else {
            $row = mysqli_fetch_array($query);
            if(strcmp($api, "false") != "0")
                $html = fillInHTML($row);
            else {
                
                $result = '';
                for($i = 0; $i < count($row); $i++) {
                    if(strcmp($row[$i], '') !== "0") #if not blank
                         if($i == 0)
                             $result .= $row[$i];
                         else
                             $result .= ',' . $row[$i];
                }
                    
                return $result;
            }
                
        }
    }
    function fillInHTML() {
        $name = $row['name'];
        $rating = $row['rating'];
        $driverCount = $row['driverCount'];
        $passengerCount = $row['passengerCount'];
        include_once($_SERVER["DOCUMENT_ROOT"] . '/gui/viewprofile.html');
        return;
    }
?>
