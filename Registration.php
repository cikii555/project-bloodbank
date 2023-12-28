<?php
require('Database.php');
$config = require('config.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Headers: Content-Type");

$data = file_get_contents("php://input");
$dbData = json_decode($data,true);
$db = new Database($config);
$user = $dbData['user'];
$email = $dbData ['email'];
$pass = $dbData['pass'];
$result = "";

if($user!="" and $email!="" and $pass !=""){
    $query = "INSERT INTO users(username,email,password)VALUES('$user','$email','$pass')";
   $res =$db->query($query);
   
$result = "You have registered successfully";

}
else {
    $result = " ";
}
$response[]= array("result"=>$result);
echo json_encode($response);



