<?php
    //open connection to mysql db
    $connection = mysqli_connect("localhost","root","","man") or die("Error " . mysqli_error($connection));
	$subject1 = $_GET['subj'];

    //fetch table rows from mysql db
	$sql =  "SELECT messagee FROM notif_teacher WHERE subjects = '{$subject1}';";
	$sql1 = "SELECT pdf_name FROM upload_pdf WHERE subjects = '{$subject1}';";
	$sql2 = "SELECT video_name FROM upload_videos_mp4 WHERE subjects = '{$subject1}';";
	$sql3 = "SELECT video_url FROM upload_videos_url WHERE subjects = '{$subject1}';";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
	$result1 = mysqli_query($connection, $sql1) or die("Error in Selecting " . mysqli_error($connection));
	$result2 = mysqli_query($connection, $sql2) or die("Error in Selecting " . mysqli_error($connection));
	$result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));

    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
	while($row1 =mysqli_fetch_assoc($result1))
	{
		$emparray[] = $row1;
	}
	while($row2 =mysqli_fetch_assoc($result2))
	{
		$emparray[] = $row2;
	}
	while($row3 =mysqli_fetch_assoc($result3))
	{
		$emparray[] = $row3;
	}
	if (json_encode($emparray, JSON_PRETTY_PRINT) === '[]') {
		echo "There isn'\t any notification for that person";
	} else {
		print(json_encode($emparray, JSON_PRETTY_PRINT));
	}
	
	
    //close the db connection
    mysqli_close($connection);
?>