<?php
    session_start();
    include('../php/conexao.php');

    if(empty($_SESSION['falha'])){

    }else{
        $falha = $_SESSION['falha'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="main">
        <div class="conteudo">
            <div class="imagem">
                <img class="img-logo" src="../imagem/SOFTWARE-GAIT-LOGO.png" alt="imagem logo">
            </div>
            <div class="formulario">
                <form action="../php/login.php" method="post">
                    <form action="../php/adm.php" method="post">
                        <div class="u-usuario">
                            <img class="icone-usuario" src="../imagem/usuario-de-perfil.png" alt="usuario">
                            <label for="usuario">Usuário</label>
                            <input type="text" name="usuario" id="usuario" minlength="1" maxlength="20" required>
                        </div>
                        <div class="u-senha">
                            <img class="icone-senha" src="../imagem/trancar.png" alt="senha">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="senha" minlength="1" maxlength="15" required>
                        </div>
                        <div class="div-submit">
                            <input type="submit" value="Entrar">
                        </div>
                    </form>
                </form>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
                <div  style="color: red; font-size: 16px; z-index:999;transform:translate(655px, 5px);width:65vh;height:3vh;font-family:helvetica;">
                    <?php
                        if(empty($_SESSION['falha'])){

                        }else{
                            echo "<div id='falha_login' style='transform:translate(9px, 0);' class='error'>".$_SESSION['falha']."</div>";
                            unset($_SESSION['falha']);
                        }
                    ?>
                </div>
                    <script>
                        $(document).ready(function(){
                            setTimeout(function() {
                                $('#falha_login').fadeOut('fast');
                            }, 3000);
                        });
                    </script>
            </div>
        </div>
    </div>
</body>
</html>