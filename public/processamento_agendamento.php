<?php
session_start();
require 'conexao.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id_user'])) {


    $data = $_POST['input_data'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $user_id = (int) $_SESSION['id_user'];
    $medico_id = filter_input(INPUT_POST, 'medico_id', FILTER_SANITIZE_NUMBER_INT);


    if (empty($data) || empty($hora) || !$medico_id) {
        header("Location: calendario.php?medico=$medico_id&erro=campos_vazios");
        exit;
    }

    try {

        $check = $conn->prepare("SELECT id_agendamentos FROM agendamentos WHERE data_agendamento = ? AND hora_agendamento = ? AND medico_id = ?");
        $check->execute([$data, $hora, $medico_id]);

        if ($check->fetch()) {

            header("Location: calendario.php?medico=$medico_id&erro=horario_ocupado");
            exit;
        } else {

            $sql = "INSERT INTO agendamentos (usuario_id, medico_id, data_agendamento, hora_agendamento, status) VALUES (?, ?, ?, ?, 'confirmado')";
            $stmt = $conn->prepare($sql);

            if ($stmt->execute([$user_id, $medico_id, $data, $hora])) {

                header("Location: minhasReservas.php?sucesso=1");
                exit;
            } else {

                header("Location: calendario.php?medico=$medico_id&erro=falha_db");
                exit;
            }
        }
    } catch (PDOException $e) {

        error_log("Erro no agendamento: " . $e->getMessage());
        die("Erro técnico: Ocorreu um problema ao processar seu agendamento.");
    }
} else {

    header("Location: login.php?erro=sessao_expirada");
    exit;
}
