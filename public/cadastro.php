<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <!-- Links -->
    <link rel="stylesheet" href="/Styles/Cadastro.css">
    <link rel="stylesheet" href="/Styles/style.css">
    <link rel="manifest" href="manifest.json">

    <meta name="theme-color" content="#317EFB">

    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    include_once('btn_cadastro.php');
    $mensagem;
    ?>

    <div class="container">
        <img src="/Images/Logo.png" alt="Logo" class="logo">
        <form action="cadastro.php" method="POST" id="formulario">

            <dialog id="modalSucesso" class="modal">
                <div class="content_modal">
                    <h2 style="color: #28a745; margin:0px 20px;"> Cadastro Realizado!</h2>
                    <p>Seu usuário foi criado com sucesso. Agora você já pode acessar sua conta.</p>
                    <br>
                    <a href="login.php" class="btn_modal_login">Ir para o Login</a>
                </div>
            </dialog>
            <p>
                <input type="text" class="nome" id="nome" name="nome" placeholder="Nome" autocomplete="off">
            </p>
            <p>

                <input type="text" class="email" id="email" name="email" placeholder="E-mail" autocomplete="off">
            </p>
            <p>

                <input type="password" class="senha" id="senha" name="senha" placeholder="Senha" autocomplete="off">
            <p id="msgError" style="color:red; display:none; text-align:center;"></p>
            <?php if (isset($mensagem)): ?>
                <p style="color: red;"><?php echo $mensagem; ?></p>
            <?php endif; ?>
            </p>
            <button class="criarconta" type="submit">Criar conta</button>
            <p>Já tenho conta. <a href="login.php">Fazer login.</a></p>
        </form>



    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

    </script>


    <script>
        const form = document.getElementById('formulario');
        const senha = document.getElementById('senha');
        const erro = document.getElementById('msgError');
        const msgCadastro = document.getElementById('msgCadastro');
        const senhaForte = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.get('sucesso') === '1') {

            Swal.fire({
                title: 'Cadastro Realizado!',
                text: 'Bem-vindo ao Agendei. Redirecionando...',
                icon: 'success',
                timer: 2500,
                background: '#161616',
                color: '#ffffff',
                showConfirmButton: false,
                timerProgressBar: true,
                willClose: () => {

                    window.location.href = 'home.php';
                }
            });
        } else if (urlParams.get('erro') === '1') {

            senha.focus();
            erro.innerText = "Minímo 8 caracteres, com maiúsculas, números e símbolos.";
            erro.style.display = "block"
        }

        form.addEventListener('submit', function(event) {



            const nome = document.getElementById('nome');
            const email = document.getElementById('email');
            const senha = document.getElementById('senha');


            erro.style.display = "none";

            if (nome.value.trim() === "") {

                event.preventDefault();

                nome.focus();
                return;
            } else if (email.value.trim() === "") {
                event.preventDefault();


                return;
            }


        })



        console.log(msgCadastro);
    </script>

</body>

</html>