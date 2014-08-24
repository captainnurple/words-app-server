<?php    
	$key;

	// Set key manually if we're in command line mode
	if (php_sapi_name() == "cli") {
    // In cli-mode
		echo 'In cli mode' . PHP_EOL;
		$key = '6ForCM1pN370iAzDYTKXZIk47SlH3Yxu';
	} else {
	    // Not in cli-mode
	    $key = $_GET['key'];
	}    

    // if ($key !== '6ForCM1pN370iAzDYTKXZIk47SlH3Yxu') {
    //     echo 'die now';
    // } else {
    //     echo 'live';
    // }
    
    $indexOfLastReceived = $_GET['indexOfLastReceived'];

    // Instantiate PDO connection
    // Specify your sqlite database name and path //
	$dir = 'sqlite:../db/phrases.sqlite';
	 
	// Instantiate PDO connection object and failure msg //
	$dbh = new PDO($dir) or die("cannot open database");

    // construct db query filtering for index great than last received
	$sql = "SELECT rowid, phrase FROM phrases WHERE rowid > ? ORDER BY rowid";
	$query = $dbh->prepare($sql);

    // test for content in json. if none return appropriate result

    // dump results into appropriate json and ret 
    	// Iterate through the results and pass into JSON encoder //
	$results = array();
//	foreach ($dbh->query($query) as $row) {
	foreach ($query->execute(array($indexOfLastReceived)) as $row) {
		$results[] = array('rowid' => $row['rowid'], 'phrase' => $row['phrase']);
	}

	echo json_encode($results);

?>