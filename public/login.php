<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Links -->
    <link rel="stylesheet" href="Styles/style.css">
    <link rel="stylesheet" href="Styles/Login.css">
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
<?php
include_once('btn_login.php');

?>

<body style="background-color: cadetblue;">
    <div class="container">
        <img src="Images/Logo.png" alt="Logo" class="logo">
        <form method="POST" id="formLogin">

            <p>

                <input type="text" class="email" id="email" name="email" placeholder="E-mail" autocomplete="off">
            </p>
            <p>

                <input type="password" class="senha" id="senha" name="senha" placeholder="Senha" autocomplete="off">
            <p id="msgErro" style="color:red; display:none;"></p>
            </p>
            <a href="home.html"><button class="acessar" type="submit">Acessar</button></a>
        </form>

        <p>Não tenho conta. <a href="cadastro.php">Criar conta agora.</a></p>

    </div>

</body>

<script>
    const form = document.getElementById("formLogin");
    const email = document.getElementById("email");
    const senha = document.getElementById("senha");
    const msgErro = document.getElementById("msgErro")
    msgErro.style.display = "none";
    const parametros = new URLSearchParams(window.location.search);

    if (parametros.get('erro') === '1') {
        msgErro.innerText = "E-mail ou senha incorretos!"
        msgErro.style.display = "block"
    }


    form.addEventListener('submit', function(event) {

        if (email.value.trim() === "") {

            email.focus();
            return;
        } else if (senha.value.trim() === "") {

            senha.focus();
            return;
        }
    });
    console.log(email)
</script>

</html>