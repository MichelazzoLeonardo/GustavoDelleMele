<?php
class DB {
    public static function getConnection() {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'minecraft_farms';
        return new mysqli($servername, $username, $password, $dbname);
    }
}

/*

require 'classes/DB.php';

$conn = DB::getConnection();

$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password';";
$user = $conn->query($query);

*/