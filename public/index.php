<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carregando</title>
        
 <link rel="manifest" href="manifest.json">
<meta name="theme-color" content="#317EFB">
<link rel="apple-touch-icon" href="icon-192.png">
    </head>

    <body>
        <style>
        body {
            background-color: blue;
            position: relative;
            height: 100dvh;
        }

        body img {
            width: 150px;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
              animation: blink 2s infinite ease-in-out;
        }
      



@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}

        #loading{
            transition: opacity 1s ease;
        }
        #loading.fade-out{
            opacity: 0;
        }
    </style>
        <div id="loading">
            <img src="Images/LogoTelaCarrega.png" alt="Logo/Carregando"
                class="logo" id="logo" style="transition: all 0.5 ease-in-out;">
        </div>
        <script>
      

  // Após 3 segundos, aplica fade-out e troca de tela
  setTimeout(() => {
    document.getElementById("loading").classList.add("fade-out");
    setTimeout(() => {
      window.location.href = "login.php"; // redireciona após o fade
    }, 2000); // espera a transição terminar
  }, 4000);
    </script>
    <script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      // Como o sw.js está na mesma pasta que o home.php, o caminho é './sw.js'
      navigator.serviceWorker.register('./sw.js')
        .then(reg => console.log('Service Worker ativo para o Agendei!'))
        .catch(err => console.log('Erro no registro:', err));
    });
  }
</script>
    </body>

</html>