<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicos</title>
    <!-- Links -->
     <link rel="stylesheet" href="/Styles/servicos.css">
     <link rel="stylesheet" href="/Styles/style.css">
     <link rel="manifest" href="./manifest.json">
<link rel="manifest" href="manifest.json">
<meta name="theme-color" content="#317EFB">
<link rel="apple-touch-icon" href="icon-192.png">
</head>
<body>
   <?php 
   include_once 'pesquisaHomeServicos.php';
   ?>
    <header>
        <a href="home.php"><img src="Images/flexaBlue.png" alt=""></a>

            <h2>Serviços</h2>
    </header>
    <div class="perfil">
       
            
        <img src="Images/<?php echo $medico['foto'] ?: '/Images/DR.png'; ?>" alt="DOUTORA">
        <div class="texts">
              <h3><?php echo htmlspecialchars($medico['nome']); ?></h3>
        <span><?php echo htmlspecialchars($medico['especialidade']); ?></span>
        </div>
       
        
    </div>
    <div class="servicos">

         <div class="servico_card">
            <div class="textServico">
                <h2>Consulta</h2>
                <span>R$300,00</span>
            </div>
            <a href="agendar.php?medico=<?php echo $medico['id_medico'];?>"><button class="btn-agenda">
                Agendar
            </button></a>
        </div>

          <div class="servico_card">
            <div class="textServico">
                <h2>Cirurgia</h2>
                <span>R$3.000,00</span>
            </div>
            <a href="agendar.php?medico=<?php echo $medico['id_medico'];?>"><button class="btn-agenda">
                Agendar
            </button></a>
        </div>
        </div>
    </div>
</body>
</html>