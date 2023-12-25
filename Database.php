<?php
class Database {
 public $connection;
    public function __construct($config){

       $pdo = 'mysql:'. http_build_query($config,'',';');
        $this->connection = new PDO($pdo, 'root', 'matematika8.');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connected to the database successfully!';
    }
public function query($query){
$statement = $this->connection->prepare($query);
$statement->execute();
return $statement;
}

}
?>