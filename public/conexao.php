<?php
$host = 'localhost';
$db = 'appagendei';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    die("Erro ao se conectar com o BD: " . $erro->getMessage());
}
