<?php
require('Database.php');
$config = require ('config.php');
require_once __DIR__ . '/vendor/autoload.php';


use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Headers: Content-Type");

$db = new Database($config);
$eData = file_get_contents("php://input");
$dData = json_decode($eData,true);

$username = $dData['user'];
$password  = $dData['password'];

$result = "";

if ($username!= "" and $password!=""){



    $sql = "SELECT * FROM users WHERE username ='$username';";
    $res = $db->query($sql);
    if ($res->rowCount()!= 0){
        $row = $res->fetch(PDO::FETCH_ASSOC);


        if($password!= $row['password']){
            $result = "Invalid password!";
            echo json_encode([
                'status'=>0,
                'message'=>$result
            ]);
        }else {

            $payload = [
                'iss'=>"localhost",
                'aud'=>"localhost",
                'exp'=>time()+ 10000,
                'data'=>[
                    'username'=>$row['username'],
                    'email' => $row['email']
                ]
            ];
            $secret_key = 'cvetic';
                $jwt = JWT::encode($payload,$secret_key,'HS256');
                echo json_encode([
                    'status'=>1,
                    'message'=> 'Logged in succesfully',
                    'jwt'=> $jwt
                ]);


            $result = " logged in successfully! Redirecting...";
        }
        }
    else {
        $result = "Invalid username!";
        echo json_encode([
            'status'=>0,
            'message'=>$result
        ]);
    }
}
else {
    $result = "";
    echo json_encode([
        'status'=>0,
        'message'=>$result
    ]);
}
