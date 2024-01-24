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
$name = $dbData['name'];
$surname = $dbData['surname'];
$address = $dbData['address'];
$city = $dbData['city'];
$country = $dbData['country'];
$occupation = $dbData['occupation'];
$idNumber = $dbData['idNumber'];
$phoneNumber = $dbData['phoneNumber'];

$result = "";

if($user!="" and $email!="" and $pass !=""){
    $query = "INSERT INTO users(username,email,password,name, surname, address,city,country, occupation,idNumber, phoneNumber)VALUES('$user','$email','$pass','$name','$surname','$address','$city','$country','$occupation','$idNumber','$phoneNumber')";
   $res =$db->query($query);
   
$result = "You have registered successfully";

}
else {
    $result = " ";
}
$response[]= array("result"=>$result);
echo json_encode($response);



