<?php
// 1. Define que o retorno é JSON
header('Content-Type: application/json');
require 'conexao.php';

// 2. Troca para $_GET (para bater com o seu fetch)
$data = $_GET['data'] ?? ''; 

if($data){
    try {
        // 3. Verifique se o nome da coluna é data_agendamento (singular)
        $stmt = $conn->prepare("SELECT hora_agendamento FROM agendamentos WHERE data_agendamento = ? AND status = 'confirmado'");
        $stmt->execute([$data]);

        $ocupados = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Sempre retorna algo, mesmo que seja um array vazio []
        echo json_encode($ocupados);
    } catch (PDOException $e) {
        // Se der erro no banco, retorna o erro como JSON
        echo json_encode(['erro' => $e->getMessage()]);
    }
} else {
    // Caso não receba data, retorna array vazio para não quebrar o JS
    echo json_encode([]);
}
?>