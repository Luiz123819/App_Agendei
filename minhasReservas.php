<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Reservas</title>

    <link rel="stylesheet" href="Styles/style.css">
    <link rel="stylesheet" href="Styles/minhasReservas.css">



    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
  <!-- PWA - APP -->
<link rel="manifest" href="manifest.json" crossorigin="use-credentials">
  <script>
  if(typeof navigator.serviceWorker !== 'undefined'){
    navigator.serviceWorker.register('pwabuilder-sw.js');
  }
  </script>
</head>

<body>

    <?php



    session_start();
    require 'conexao.php';

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['id_user'];

    $sql = "SELECT a.id_agendamentos, a.data_agendamento, a.hora_agendamento, a.status, m.nome AS medico_nome, m.especialidade FROM agendamentos a JOIN medicos m ON a.medico_id = m.id_medico WHERE a.usuario_id = ? ORDER BY a.data_agendamento DESC, a.hora_agendamento DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <nav>
        <h2>Minhas Reservas</h2>
    </nav>
    <div class="cards">
        <?php if (count($reservas) > 0): ?>
            <?php foreach ($reservas as $reserva): ?>
                <div class="card">
                    <div>
                        <h2>Consulta - <?php echo htmlspecialchars($reserva['medico_nome']); ?></h2>
                        <span><?php echo htmlspecialchars($reserva['especialidade']); ?></span>
                    </div>
                    <span id="date">
                        <img src="/Images/CALENDARIO.png" alt="Calendário">
                        <?php echo date('d/m/Y', strtotime($reserva['data_agendamento'])); ?>
                    </span>

                    <span id="hours">
                        <img src="/Images/relogio.png" alt="Relógio">
                        <?php echo date('H:i', strtotime($reserva['hora_agendamento'])); ?>
                    </span>
                    <button class="cancelarConsulta" id="cancelarConsulta" onclick="excluirAgendamento(<?php echo $reserva['id_agendamentos']; ?>)">
                        Cancelar Reserva
                    </button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h2 style="padding:20px;" id="status">Você ainda não possui agendamentos!</h2>
        <?php endif; ?>
    </div>

    <header>
        <?php

        $pagina_atual = basename($_SERVER['PHP_SELF']);
        ?>
        <div class="nav-bar">
            <a href="home.php" class="menu_item <?= ($pagina_atual == 'home.php') ? 'active' : '' ?>"></i><i class="fa-solid fa-house"></i></a>
            <a href="minhasReservas.php" class="menu_item <?= ($pagina_atual == 'minhasReservas.php') ? 'active' : '' ?>"><i class="fa-solid fa-calendar"></i></a>
            <a href="perfil.php" class="menu_item <?= ($pagina_atual == 'perfil.php') ? 'active' : '' ?>"><i class="fa-solid fa-user"></i></a>
        </div>
    </header>
    <script src="Js/main.js"></script>
    <script src="Js/transicao.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const botaoCancelar = document.getElementById("cancelarConsulta");

        function excluirAgendamento(idAgendamento) {
            Swal.fire({
                title: 'Deseja cancelar a reserva?',
                text: 'Esta ação não poderá ser desfeita',
                icon: 'warning',

                background: '#161616',
                color: '#ffffff',
                iconColor: '#e63946',


                showCancelButton: true,
                confirmButtonText: 'Sim, excluir',
                cancelButtonText: 'Manter reserva',
                confirmButtonColor: '#e63946',
                cancelButtonColor: '#323434',


                heightAuto: false,
                customClass: {
                    popup: 'premium-popup',
                    confirmButton: 'premium-confirm',
                    cancelButton: 'premium-cancel'
                }
            }).then((results) => {
                if (results.isConfirmed) {
                    window.location.href = "delete.php?id=" + idAgendamento;
                    console.log("Excluir");
                } else if (results.isDismissed) {

                    console.log('return')
                }
            })
        };

        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('sucesso') === '1') {
            Swal.fire({
                title: 'Sucesso!',
                text: 'Sua reserva foi confirmada.',
                icon: 'success',
                background: '#161616',
                color: '#ffffff',

                confirmButtonColor: '#004cff'
            });
        }
    </script>

</body>

</html>