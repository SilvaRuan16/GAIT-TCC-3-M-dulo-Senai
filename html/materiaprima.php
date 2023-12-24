<?php

    session_start();
    include('../php/conexao.php');

    $mat = '';
    if(isset($_POST['nome']))
    {
        $mat = $_POST['nome'];
    }
    $query = $dbh->prepare('SELECT * FROM materia_prima WHERE nome LIKE :nome;');

    $query->execute(array(
        ':nome' => "%$mat%"
    ));
    $materia_prima = $query->fetchAll();

    if(empty($_SESSION['inserir_sucesso'])){
    
    }else{
        $mensagem = $_SESSION['inserir_sucesso'];
    }

    if(empty($_SESSION['inserir_erro'])){
    
    }else{
        $mensagem = $_SESSION['inserir_erro'];
    }

    if(empty($_SESSION['update_sucesso'])){
    
    }else{
        $mensagem = $_SESSION['update_sucesso'];
    }

    if(empty($_SESSION['update_erro'])){
    
    }else{
        $mensagem = $_SESSION['update_erro'];
    }

    if(empty($_SESSION['delete_sucesso'])){
    
    }else{
        $mensagem = $_SESSION['delete_sucesso'];
    }

    if(empty($_SESSION['delete_erro'])){
    
    }else{
        $mensagem = $_SESSION['delete_erro'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/materiaprima.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Matéria prima</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="main-conteudo">
        <div class="pesquisa">
            <form action="" method="post">
                <input type="text" name="nome" id="pesquisar" placeholder="Pesquisar">
                <input type="submit" class="bt-pesquisa" value="Pesquisar"></input>
            </form>
        </div>

        <div class="new-button">
            <button class="botao-novo"><a href="cadastro_materia_prima.php">Novo</a></button>
        </div>

        <div class="div-tabela">
            <table>
                <thead>
                    <tr>
                        <th>Cód</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Categoria</th>
                        <th>Observação</th>
                        <th>Data</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($materia_prima as $materia){
                            echo '<tr>';
                            echo '<td>'.$materia['cod_materia'].'</td>';
                            echo '<td>'.$materia['nome'].'</td>';
                            echo '<td>'.$materia['descricao'].'</td>';
                            echo '<td>'.$materia['quantidade'].'</td>';
                            echo '<td>'.$materia['valor'].'</td>';
                            echo '<td>'.$materia['status'].'</td>';
                            echo '<td>'.$materia['categoria'].'</td>';
                            echo '<td>'.$materia['observacao'].'</td>';
                            echo '<td>'.$materia['data'].'</td>';
                            echo '<td><a href="editar_cadastro_materia_prima.php?cod_materia='.$materia['cod_materia'].'">Editar</a></td>';
                            echo '<td><a href="../php/delete_materia.php?cod_materia='.$materia['cod_materia'].'">Excluir</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="main">
        <div class="navbar">
            <div class="logo">
                <button>
                    <a href="index.php"><img class="imagem-logo" src="../imagem/SOFTWARE-GAIT-LOGO.png"
                            alt=""></a>
                        </button>
            </div>
            <nav>
            <a class="link" href="inicio.html">Inicio</a>
                <a class="link" href="fornecedores.php">Fornecedores</a>
                <a class="link" href="funcionarios.php">Funcionários</a>
                <a class="link" href="materiaprima.php">Matéria prima</a>

                <div class="button-location">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Acessar Tabelas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="orcamentos.php">Orcamento</a></li>
                            <li><a class="dropdown-item" href="estoque.php">Estoque</a></li>
                            <li><a class="dropdown-item" href="clientes.php">Clientes</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="local">
                <img src="../imagem/icon-materia-prima-removebg-preview.png" alt="">
                <h3>Matéria prima</h3>
            </div>
        </div>
    </div>

    <div  style="color: green; font-size: 18px; z-index:999;transform:translate(100px, 220px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['inserir_sucesso'])){

        }else{
            echo "<div id='insert_sucesso' class='error'>".$_SESSION['inserir_sucesso']."</div>";
            unset($_SESSION['inserir_sucesso']);
        }
        ?>
    </div>

    <div  style="color: red; font-size: 18px; z-index:999;transform:translate(100px, 200px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['inserir_erro'])){

        }else{
            echo "<div id='insert_error' class='error'>".$_SESSION['inserir_erro']."</div>";
            unset($_SESSION['inserir_erro']);
        }
        ?>
    </div>

    <div  style="color: green; font-size: 18px; z-index:999;transform:translate(100px, 180px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['update_sucesso'])){

        }else{
            echo "<div id='sucess_update' class='error'>".$_SESSION['update_sucesso']."</div>";
            unset($_SESSION['update_sucesso']);
        }
        ?>
    </div>

    <div  style="color: red; font-size: 18px; z-index:999;transform:translate(100px, 158px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['update_erro'])){

        }else{
            echo "<div id='erro_update' class='error'>".$_SESSION['update_erro']."</div>";
            unset($_SESSION['update_erro']);
        }
        ?>
    </div>


    <div  style="color: green; font-size: 18px; z-index:999;transform:translate(100px, 138px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['delete_sucesso'])){

        }else{
            echo "<div id='sucesso_delete' class='error'>".$_SESSION['delete_sucesso']."</div>";
            unset($_SESSION['delete_sucesso']);
        }
        ?>
    </div>

    <div  style="color: red; font-size: 18px; z-index:999;transform:translate(100px, 115px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['delete_erro'])){

        }else{
            echo "<div id='erro_delete' class='error'>".$_SESSION['delete_erro']."</div>";
            unset($_SESSION['delete_erro']);
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                setTimeout(function() {
                    $('#insert_sucesso').fadeOut('fast');
                }, 3000);
            });

            $(document).ready(function(){
                setTimeout(function() {
                    $('#insert_error').fadeOut('fast');
                }, 3000);
            });

            $(document).ready(function(){
                setTimeout(function() {
                    $('#sucess_update').fadeOut('fast');
                }, 3000);
            });

            $(document).ready(function(){
                setTimeout(function() {
                    $('#erro_update').fadeOut('fast');
                }, 3000);
            });

            $(document).ready(function(){
                setTimeout(function() {
                    $('#sucesso_delete').fadeOut('fast');
                }, 3000);
            });

            $(document).ready(function(){
                setTimeout(function() {
                    $('#erro_delete').fadeOut('fast');
                }, 3000);
            });
        </script>
</body>

</html>