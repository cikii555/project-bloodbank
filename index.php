<?php
require ('Database.php');
$config = require ('config.php');
$db = new Database($config);
$users  = $db->query("select * from users")->fetchAll();
print_r($users);
echo 'Hello world';




    //$users = $statement->fetchAll();
    //print_r($users) ;



?>