<?php
    //open connection to mysql db
    $connection = mysqli_connect("localhost","root","","man") or die("Error " . mysqli_error($connection));
	$nationalid = $_GET['national_id'];
	$subject = $_GET['subj'];

    //fetch table rows from mysql db
    $sql = "select messagee from notif_teacher where national_id = '{$nationalid}' and subjects = '{$subject}'";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
	if (json_encode($emparray, JSON_PRETTY_PRINT) === '[]') {
		echo "There isn'\t any notification for that person";
	} else {
		print(json_encode($emparray, JSON_PRETTY_PRINT));
	}

    //close the db connection
    mysqli_close($connection);
?>