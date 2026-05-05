<?php

header('Content-Type: application/json');
require 'conexao.php';


$data = $_GET['data'] ?? '';

if ($data) {
    try {

        $stmt = $conn->prepare("SELECT hora_agendamento FROM agendamentos WHERE data_agendamento = ? AND status = 'confirmado'");
        $stmt->execute([$data]);

        $ocupados = $stmt->fetchAll(PDO::FETCH_COLUMN);


        echo json_encode($ocupados);
    } catch (PDOException $e) {

        echo json_encode(['erro' => $e->getMessage()]);
    }
} else {

    echo json_encode([]);
}
