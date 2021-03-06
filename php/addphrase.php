<?php

  $security_key = $_GET['key'];

  require_once("/var/credentials.php"); // contains $secret_key

  if($security_key != $secret_key) die();
//  if($security_key != 'eMaca884F01L9WZ9iFLqGEgKKkR3NbY7') die();


   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('../db/phrases.sqlite');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }

$query = <<<EOD
  CREATE TABLE IF NOT EXISTS phrases (rowid INTEGER PRIMARY KEY AUTOINCREMENT, phrase TEXT, date TEXT)
EOD;

    $db->exec($query);
?>

<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 
<?php
// define variables and set to empty values
$phraseErr = $emailErr = $genderErr = $websiteErr = "";
$phrase = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["phrase"])) {
     $phraseErr = "Nothing received";
   } else {
     $phrase = $_POST["phrase"];     

     $esc_phrase = SQLite3::escapeString($phrase);
     echo $esc_phrase . '\n';
     $createdDate = date('F jS, Y');
$query = <<<EOD
  INSERT INTO phrases (phrase, date) VALUES ('$esc_phrase', '$createdDate')
EOD;
     echo $query . '\n';

    $db->exec($query) or die("Unable to add phrase $phrase");

   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>

<h2>Send New Love Phrase</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?key=' . $security_key;?>"> 
   Phrase: <input type="text" name="phrase" value="<?php echo $phrase;?>">
   <span class="error">* <?php echo $phraseErr;?></span>
   <br><br>   
   <input type="submit" name="submit" value="Submit"> 
</form>

<?php
echo "<h2>Successfully Input:</h2>";
    $result = $db->query('select * from phrases order by rowid desc limit 1') or die('Query failed');

    while ($row = $result->fetchArray())
    {
      echo "{$row['rowid']} - {$row['phrase']}\n";
    }
echo "<br>";
echo "<h2>Total List:</h2>";
    $result = $db->query('SELECT * FROM phrases') or die('Query failed');

    while ($row = $result->fetchArray())
    {
      echo "{$row['rowid']} - {$row['phrase']}\n";
    }
echo "<br>";

?>

</body>
</html>