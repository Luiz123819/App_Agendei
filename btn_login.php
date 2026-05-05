<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message="";

session_start();


include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
     
  
    $stmt = $conn->prepare("SELECT * FROM cadastro WHERE email_user = ? LIMIT 1");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($usuario && password_verify($senha, $usuario['senha'])) { 
     
        $_SESSION['id_user'] = $usuario['id_user'];
        $_SESSION['nome_user'] = $usuario['nome_user'];
        $_SESSION['email_user'] = $usuario['email_user']; 
        
        header("Location: home.php"); 
        exit;
    } else {
        
        header("Location: login.php?erro=1");
        exit;
    }
}
?>