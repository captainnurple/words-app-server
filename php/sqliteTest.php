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

$query = <<<EOD
  CREATE TABLE IF NOT EXISTS phrases (rowid INTEGER PRIMARY KEY AUTOINCREMENT, phrase TEXT)
EOD;

    $db->exec($query);

    $phrase = SQLite3::escapeString('Oh hi baby I love you!!');
$query = <<<EOD
  INSERT INTO phrases (phrase) VALUES ( '$phrase')
EOD;

    $db->exec($query) or die("Unable to add phrase $phrase");
    $result = $db->query('SELECT * FROM phrases') or die('Query failed');

    while ($row = $result->fetchArray())
    {
      echo "Phrase: {$row['rowid']}\n - {$row['phrase']}\n";
    }

?>