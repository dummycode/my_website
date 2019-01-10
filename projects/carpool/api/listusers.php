<?php
    if(strcmp($_GET['api'], "false") == "0") #if not api
    {
    	#clear get vars for future calls
    	$_GET['api'] = '';
        echo api_listUsers();
    }
        
    #else do nothing

    function api_listUsers()
    {
    	#connect to database
        include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ConnectToDatabase.php');
        $con = connectToDatabase();
        if($con == false)
            return "Error connecting to database";
            
        $query = mysqli_query($con, "SELECT * FROM users");
        if(mysqli_num_rows($query) == 0)
            return "no users found";
        
        $counter = 0;
        $result = "";
		#compile all the users into variable
        while($row = mysqli_fetch_array($query))
        {
            if($counter === 0) #if first 
                $result = $row['username'];
            else #if not first user, add it and seperate by comma
                $result .= ',' . $row['username'];
            $counter = $counter + 1;
        }
        mysqli_close($con); #close sql connection
        return $result;
    }
?>
