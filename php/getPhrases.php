<?php
    echo $_GET['latest'] . PHP_EOL; 
    echo $_GET['key'] . PHP_EOL; 
    
    $key = $_GET['key'];
    echo $key . PHP_EOL;
    
    if ($key !== '6ForCM1pN370iAzDYTKXZIk47SlH3Yxu') {
        echo 'die now';
    } else {
        echo 'live';
    }
?>