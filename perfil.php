<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="/Styles/style.css">
    <link rel="stylesheet" href="/Styles/perfil.css">

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

    try {

        $id_logado = $_SESSION['id_user'] ?? 1;

        $query = "SELECT nome_user, email_user FROM cadastro WHERE id_user = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_logado]);


        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $emailFormat = strtolower(trim($user['email_user'] ?? ''));

        $hash_gravatar = md5($emailFormat);


        $urlGravatar = "https://www.gravatar.com/avatar/" . $hash_gravatar . "?s=150&d=mp";

        if (!$user) {
            die("Usuário não encontrado.");
        }
    } catch (PDOException $e) {
        echo "Erro ao carregar dados: " . $e->getMessage();
    }
    ?>

    <nav>
        <h2>Meu Perfil</h2>
    </nav>


    <div class="card">
        <div class="fotoPerfil">
            <img src="<?php echo $urlGravatar; ?>" alt="Foto perfil">
        </div>
        <div class="dado">
            <p>Nome</p>
            <h2><?php echo htmlspecialchars($user['nome_user']); ?></h2>
        </div>
        <div class="dado" style="margin-bottom: 100px;">
            <p>E-mail</p>
            <h2><?php echo htmlspecialchars($user['email_user']); ?></h2>
        </div>
    </div>
    <button class="btn_logout" onclick="sairPerfil()">Sair</button>

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
        function sairPerfil() {
            Swal.fire({
                title: 'Deseja sair?',
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
                    window.location.href = "btn_logout.php";
                }
            })
        }
    </script>

</body>

</html>