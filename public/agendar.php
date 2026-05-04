<?php
session_start();
require 'conexao.php';
$medico_selecionado = filter_input(INPUT_GET, 'medico', FILTER_SANITIZE_NUMBER_INT);

if (!$medico_selecionado) {
  header("Location: servicos.php");
  exit;
}

$nome_do_medico = "";

$stmt = $conn->prepare("SELECT nome FROM medicos WHERE id_medico = ?");
$stmt->execute([$medico_selecionado]);
$medico = $stmt->fetch();

if ($medico) {
  $nome_do_medico = $medico['nome'];
} else {

  header("Location: servicos.php");
  exit;
}
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calendário - Reserva</title>

  <link rel="stylesheet" href="/Styles/style.css" />
  <link rel="stylesheet" href="/Styles/calendario.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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

  <header>
    <div class="nav-bar">
      <a href="servicos.php?medico=<?php echo $medico_selecionado; ?>">
        <img src="/Images/flexaWite.png" alt="Botão Voltar" />
      </a>
      <h3>Fazer uma reserva</h3>
    </div>
  </header>

  <div class="containerPrincipal">
    <div class="container">

      <p class="agendando-com">
        Você está agendando com: <strong><?php echo htmlspecialchars($nome_do_medico); ?></strong>
      </p>

      <form action="processamento_agendamento.php" method="POST" id="formReserva">

        <input type="hidden" name="medico_id" value="<?php echo $medico_selecionado; ?>">

        <div class="calendar">
          <div class="header">
            <button type="button" id="prev"><i class="fa-solid fa-caret-left"></i></button>
            <h2 id="monthYear"></h2>
            <button type="button" id="next"><i class="fa-solid fa-caret-right"></i></button>
          </div>
          <div class="weekdays">
            <div>Dom</div>
            <div>Seg</div>
            <div>Ter</div>
            <div>Qua</div>
            <div>Qui</div>
            <div>Sex</div>
            <div>Sáb</div>
          </div>
          <div class="days" id="days"></div>
        </div>

        <input type="hidden" name="input_data" id="input_data" required />

        <div id="hora_div" style="margin-top: 20px;">
          <label for="hora">Horário:</label>
          <select name="hora" id="hora" required>
            <option value="">Selecione um horário</option>
            <option value="09:00">09:00</option>
            <option value="11:00">11:00</option>
            <option value="14:00">14:00</option>
            <option value="18:00">18:00</option>
          </select>
        </div>

        <button class="agendar" type="submit" style="margin-top: 20px;">Confirmar Reserva</button>
      </form>

    </div>
  </div>


  <script src="Js/main.js"></script>


</body>

</html>