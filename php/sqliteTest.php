<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('../db/test.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }


    $phrase = sqlite_escape_string('Oh hi baby I love you!!');
$query = <<<EOD
  INSERT INTO phrases VALUES ( '$phrase')
EOD;

    $db->exec($query) or die("Unable to add phrase $phrase");
    $result = $db->query('SELECT * FROM phrases') or die('Query failed');

    while ($row = $result->fetchArray())
    {
      echo "Phrase: {$row['phrase']}\n";
    }

?>