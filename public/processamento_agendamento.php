<?php
session_start();
require 'conexao.php';

// 1. Verifica se o usuário está logado e se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id_user'])) {
    
    // Recebendo e limpando os dados
    $data      = $_POST['input_data'] ?? '';
    $hora      = $_POST['hora'] ?? '';
    $user_id   = $_SESSION['id_user']; // Usando o padrão id_user
    $medico_id = $_POST['medico_id'] ?? '';

    // Validação básica
    if (empty($data) || empty($hora) || empty($medico_id)) {
        header("Location: calendario.php?medico=$medico_id&erro=campos_vazios");
        exit;
    }

    try {
        // 2. Verifica se o médico já tem agendamento (independente de status, para evitar conflito)
        $check = $conn->prepare("SELECT id_agendamentos FROM agendamentos WHERE data_agendamento = ? AND hora_agendamento = ? AND medico_id = ?");
        $check->execute([$data, $hora, $medico_id]);

        if ($check->fetch()) {
            // Em vez de 'echo', melhor redirecionar com uma mensagem de erro
            header("Location: calendario.php?medico=$medico_id&erro=horario_ocupado");
            exit;
        } else {
            // 3. O INSERT com status inicial 'confirmado' ou 'pendente'
            $sql = "INSERT INTO agendamentos (usuario_id, medico_id, data_agendamento, hora_agendamento, status) VALUES (?, ?, ?, ?, 'confirmado')";
            $stmt = $conn->prepare($sql);

            if ($stmt->execute([$user_id, $medico_id, $data, $hora])) {
                header("Location: minhasReservas.php?msg=sucesso");
                exit;
            } else {
                echo "Erro ao salvar no banco de dados.";
            }
        }
    } catch (PDOException $e) {
        die("Erro técnico: " . $e->getMessage());
    }
} else {
    // Se tentar acessar o arquivo sem logar ou sem enviar o form
    header("Location: login.php");
    exit;
}
?>