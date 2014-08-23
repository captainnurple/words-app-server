<?php    
    // $key = $_GET['key'];
    
    // if ($key !== '6ForCM1pN370iAzDYTKXZIk47SlH3Yxu') {
    //     echo 'die now';
    // } else {
    //     echo 'live';
    // }
    
    // $indexOfLastReceived = $_GET['indexOfLastReceived'];

    // Instantiate PDO connection
    // Specify your sqlite database name and path //
	$dir = 'sqlite:../db/phrases.sqlite';
	 
	// Instantiate PDO connection object and failure msg //
	$dbh = new PDO($dir) or die("cannot open database");

    // construct db query filtering for index great than last received
	$query = "SELECT rowid, phrase FROM phrases";

    // test for content in json. if none return appropriate result

    // dump results into appropriate json and ret 
    	// Iterate through the results and pass into JSON encoder //
	foreach ($dbh->query($query) as $row) {
		echo json_encode(array($row['rowid'], $row['phrase']);
	}

?>