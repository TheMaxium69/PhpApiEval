<?php
class Database 
{

    public static function getPdo(){

        $pdo = new PDO('mysql:host=localhost;dbname=exam3','resto' ,'resto', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_PERSISTENT
            ]);

          return $pdo;

    }
}




