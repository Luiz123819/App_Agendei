<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carregando</title>

  <!-- PWA - APP -->
 <link rel="manifest" href="manifest.json" crossorigin="use-credentials">
  <script>
  if(typeof navigator.serviceWorker !== 'undefined'){
    navigator.serviceWorker.register('pwabuilder-sw.js');
  }
  </script>
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

      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: 0;
      }
    }

    #loading {
      transition: opacity 1s ease;
    }

    #loading.fade-out {
      opacity: 0;
    }
  </style>
  <div id="loading">
    <img src="Images/LogoTelaCarrega.png" alt="Logo/Carregando"
      class="logo" id="logo" style="transition: all 0.5 ease-in-out;">
  </div>
  <script>
    setTimeout(() => {
      document.getElementById("loading").classList.add("fade-out");
      setTimeout(() => {
        window.location.href = "login.php";
      }, 2000);
    }, 4000);
  </script>

</body>

</html>