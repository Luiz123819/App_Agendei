<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); // OBRIGATÓRIO iniciar aqui para salvar os dados
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO cadastro (nome_user, email_user, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute([
            ':nome'  => $nome,
            ':email' => $email,
            ':senha' => $senhaHash
        ]);

        // LOGAR AUTOMATICAMENTE
        $novo_id = $conn->lastInsertId();
        $_SESSION['id_user']    = $novo_id;
        $_SESSION['nome_user']  = $nome;
        $_SESSION['email_user'] = $email;

        // Redireciona para a home
        header("Location: home.php");
        exit;
        
    } catch (PDOException $erro) {
        if ($erro->getCode() == '23000') {
            $mensagem = "Erro: Este e-mail já está cadastrado!";
        } else {
            $mensagem = "Erro ao cadastrar: " . $erro->getMessage();
        }
    }
}
?>