<?php
    $email = $argv[1];
    $message = $argv[2];
    file_get_contents('http://dummycode.com/f/sendmail.php?email=' . $email . '&message=' . $message);
?>
