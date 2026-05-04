<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Agendei - Serviços</title>

    <link rel="stylesheet" href="/Styles/style.css">
    <link rel="stylesheet" href="/Styles/servicos.css">

    <link rel="manifest" href="manifest.json">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-status-bar-style" content="black-translucent">

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
    include_once 'pesquisaHomeServicos.php';
    ?>

    <header>
        <a href="home.php">
            <img src="Images/flexaBlue.png" alt="Voltar">
        </a>
        <h2>Serviços</h2>
        <div style="width: 45px;"></div>
    </header>

    <main>
        <div class="perfil">
            <img src="Images/<?php echo !empty($medico['foto']) ? $medico['foto'] : 'DR.png'; ?>"
                alt="Foto do Profissional">

            <div class="texts">
                <h3><?php echo htmlspecialchars($medico['nome']); ?></h3>
                <span><?php echo htmlspecialchars($medico['especialidade']); ?></span>
            </div>
        </div>

        <div class="servicos">
            <div class="servico_card">
                <div class="textServico">
                    <h2>Consulta</h2>
                    <span>R$ 300,00</span>
                </div>
                <a href="agendar.php?medico=<?php echo $medico['id_medico']; ?>">
                    <button class="btn-agenda">Agendar</button>
                </a>
            </div>

            <div class="servico_card">
                <div class="textServico">
                    <h2>Cirurgia</h2>
                    <span>R$ 3.000,00</span>
                </div>
                <a href="agendar.php?medico=<?php echo $medico['id_medico']; ?>">
                    <button class="btn-agenda">Agendar</button>
                </a>
            </div>
        </div>
    </main>

</body>

</html>