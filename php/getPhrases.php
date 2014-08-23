<?php

    var $providedKey = $_GET['key'];

    if ($providedKey !== '123') die();
    
    echo 'here' . PHP_EOL;
    echo $_GET['latest']; 
?>