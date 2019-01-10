<?php

	/*
	* USAGE
	* include_once('ConnectToDatabase.php);
	* $connection = connectToDatabase();
	*
	* RETURNS
	* mysqli connection variable
	*/
	connectToDatabase();
    function connectToDatabase()
    {
        $connection = mysqli_connect('127.0.0.1', 'root', 'F00tball1');
		mysqli_query($connection, "USE carpool;");
        return $connection;
    }
?>