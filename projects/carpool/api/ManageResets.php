<?php
    include_once('/var/www/api/ConnectToDatabase.php'); #absolute path for crontab
    $con = connectToDatabase();
    if($con == false)
        echo "Error connecting to database" . PHP_EOL;
    $query = mysqli_query($con, "DELETE FROM resets WHERE expiration < NOW()");
    echo "terminated " . mysqli_affected_rows($con) . " reset code(s)" . PHP_EOL;
?>
