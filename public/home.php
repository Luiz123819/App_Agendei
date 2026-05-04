<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Links -->
    <link rel="stylesheet" href="https://unpkg.com/skeleton-elements/skeleton-elements.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/Styles/style.css">
    <link rel="stylesheet" href="/Styles/home.css">
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#317EFB">
    <link rel="apple-touch-icon" href="icon-192.png">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="manifest" href="manifest.json">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(reg => console.log('PWA Ativo!'))
                    .catch(err => console.log('Erro no PWA', err));
            });
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


    $nomeUsuario = $_SESSION['nome_user'] ?? 'Visitante';
    $emailUsuario = $_SESSION['email_user'] ?? '';


    $emailLimpo = strtolower(trim((string)$emailUsuario));
    $hash_gravatar = md5($emailLimpo);
    $urlGravatar = "https://www.gravatar.com/avatar/" . $hash_gravatar . "?s=150&d=mp";


    try {
        $query = "SELECT id_medico, nome, especialidade, foto FROM medicos ORDER BY nome ASC";
        $stmt = $conn->query($query);
        $medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>
    <nav class="nav-bar" style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background: #007bff; color: white;">
        <div class="test-nav">
            <h2 style="margin:0;" class="skeleton-text">Olá, <?= htmlspecialchars($nomeUsuario) ?>!</h2>
            <span>Como podemos ajudar hoje?</span>
        </div>
        <div class="user-photo">
            <a href="perfil.php"> <img src="<?= $urlGravatar ?>" alt="Foto de <?= htmlspecialchars($nomeUsuario) ?>"
                    style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover; border: 2px solid #fff;"> </a>
        </div>
    </nav>

    <div class="container">
        <p class="subtitle">
            Agende os seus serviços médicos
        </p>

        <div class="cards">
            <?php if (count($medicos) > 0): ?>
                <?php foreach ($medicos as $medico): ?>
                    <a href="servicos.php?medico=<?php echo $medico['id_medico']; ?>" style="text-decoration:none; width:100%;">
                        <div class="card">

                            <img src="Images/<?php echo $medico['foto'] ?: '/Images/DR.png'; ?>" alt="Médico">
                            <div class="content">
                                <h3><?php echo htmlspecialchars($medico['nome']); ?></h3>
                                <span> <?php echo htmlspecialchars($medico['especialidade']); ?></span>

                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum médico encontrado no momento</p>
            <?php endif; ?>
        </div>
    </div>
    <header>
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
        <link rel="manifest" href="manifest.json">

        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('sw.js')
                        .then(reg => console.log('SW registrado!', reg))
                        .catch(err => console.error('Erro no SW:', err));
                });
            }
        </script>
</body>

</html>