<?php
session_start();
require 'conexao.php';


if (isset($_GET['id']) && isset($_SESSION['id_user'])) {
    $id_reserva = $_GET['id'];
    $user_id = $_SESSION['id_user'];

    try {

        $sql = "DELETE FROM agendamentos WHERE id_agendamentos = ? AND usuario_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute([$id_reserva, $user_id])) {

            header("Location: minhasReservas.php?status=deletado");
            exit;
        } else {
            die("Erro ao excluir a reserva.");
        }
    } catch (PDOException $e) {
        die("Erro no banco de dados: " . $e->getMessage());
    }
} else {

    header("Location: login.php");
    exit;
}
