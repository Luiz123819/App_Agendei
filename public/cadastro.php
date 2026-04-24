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
</head>
<body>
    
    <!-- <?php 
    include_once('btn_cadastro.php');
   
    ?> -->
    
        <div class="container">
            <img src="/Images/Logo.png" alt="Logo" class="logo">
            <form action="cadastro.php"  method="POST" id="formulario">
                 
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
                    <p id="msgError" style="color:red; display:none;">ikkkk</p>
                </p>
              <button class="criarconta" type="submit">Criar conta</button>
            </form>

           
      <p>Já tenho conta. <a href="login.php">Fazer login.</a></p>
        </div>
         
        <?php if (isset($cadastroRealizado) && $cadastroRealizado): ?>

        <script src="transicao.js"></script>

    <script>
        const meuModal = document.getElementById('modalSucesso');
        // showModal() abre o modal e cria o fundo escuro (backdrop)
        meuModal.showModal();
        console.log(meuModal)

        meuModal.addEventListener('click', (e) => {
            if (e.target === meuModal) meuModal.close();
        });
    </script>
<?php endif; ?>
        <script>
            const form = document.getElementById('formulario');
            const senha = document.getElementById('senha');
            const erro = document.getElementById('msgError');
            const msgCadastro = document.getElementById('msgCadastro');
           
                  
       
            form.addEventListener('submit', function(event) {

                

                const nome = document.getElementById('nome');
                const email = document.getElementById('email');
                const senha = document.getElementById('senha');

            //Limpa o erro anterion
            erro.style.display="none";

                if(nome.value.trim() === ""){

                    event.preventDefault();
                    alert("Por favor, preencha o campo nome.");
                    nome.focus();
                    return;
                } else if( email.value.trim() === "" ){
                     event.preventDefault();
                    alert("Por favor, preencha o campo email.");
                    email.focus();
                    return;
                }
                 else if( senha.value.trim() === "" ){
                     event.preventDefault();
                    alert("Por favor, preencha o campo senha.");
                    email.focus();
                }
                if(senha.value.length < 6){
                    event.preventDefault();
                    erro.innerText = "A senha deve ter pelo menos 6 caracteres!";
                    erro.style.display ="block"
                }

               
                })

   

     console.log(msgCadastro);

                

                  
        </script>
      
</body>
</html>