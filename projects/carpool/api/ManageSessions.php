<?php
    #include_once('/var/www/api/ConnectToDatabase.php'); #absolute path for crontab
    include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php'); #for testing
    $con = connectToDatabase();
    if($con == false)
        echo "Error connecting to database" . PHP_EOL;
    $query = mysqli_query($con, "DELETE FROM sessions WHERE expiration < NOW()");
    echo "terminated " . mysqli_affected_rows($con) . " session(s)" . PHP_EOL;
?>
