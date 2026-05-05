<?php
require 'conexao.php';

try {
    // 1. Garante que a sessão está iniciada para usar o ID
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    $id = $_GET['medico'] ?? '';
 

    $query = "SELECT id_medico, nome, especialidade, foto FROM medicos WHERE id_medico = ?";

    $stmt = $conn->prepare($query);

    $stmt->execute([$id]);

    $medico = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$medico) {
        echo "Médico não encontrado no banco de dados.";
    }
} catch (PDOException $e) {
    echo "Erro ao carregar médico: " . $e->getMessage();
}
