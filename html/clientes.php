<?php

    session_start();
    include('../php/conexao.php');

    $nome = '';
    if(isset($_POST['nome']))
    {
        $nome = $_POST['nome'];
    }
    $query = $dbh->prepare('SELECT * FROM cliente WHERE nome LIKE :nome;');
    $query->execute(array(
        ':nome' => "%$nome%"
    ));

    $clientes = $query->fetchAll();

    if(empty($_SESSION['mensagem'])){
    
    }else{
        $mensagem = $_SESSION['mensagem'];
    }

    if(empty($_SESSION['msm'])){

    }else{
        $mensagem = $_SESSION['msm'];
    }

    if(empty($_SESSION['salvar'])){

    }else{
        $mensagem = $_SESSION['salvar'];
    }

    if(empty($_SESSION['inserir_error'])){

    }else{
        $mensagem = $_SESSION['inserir_error'];
    }

    if(empty($_SESSION['update_cliente'])){

    }else{
        $mensagem = $_SESSION['update_cliente'];
    }

    if(empty($_SESSION['error_edit'])){

    }else{
        $mensagem = $_SESSION['error_edit'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/clientes.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Clientes</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="main-conteudo">
        <div class="pesquisa">
            <form action="" method="post">
                <input type="text" name="nome" id="pesquisar" placeholder="Pesquisar clientes">
                <input type="submit" class="bt-pesquisa" value="Pesquisar"></input>
            </form>
        </div>

        <div class="new-button">
            <button class="botao-novo"><a href="cadastro_clientes.php">Novo</a></button>
        </div>

        <div class="div-tabela">
            <table>
                <thead>
                    <tr>
                        <th>Cód</th>
                        <th>Nome</th>
                        <th>Data Nascimento</th>
                        <th>CPF</th>
                        <th>CNPJ</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>CEP</th>
                        <th>RG</th>
                        <th>Endereço</th>
                        <th>Cidade</th>
                        <th>Nº Endereço</th>
                        <th>Status Cliente</th>
                        <th>Bairro</th>
                        <th>Tipo Pessoa</th>
                        <th>Data</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($clientes as $cliente){
                    echo '<tr>';
                    echo '<td>'.$cliente['cod_cliente'].'</td>';
                    echo '<td>'.$cliente['nome'].'</td>';
                    echo '<td>'.$cliente['data_nascimento'].'</td>';
                    echo '<td>'.$cliente['cpf'].'</td>';
                    echo '<td>'.$cliente['cnpj'].'</td>';
                    echo '<td>'.$cliente['telefone'].'</td>';
                    echo '<td>'.$cliente['email'].'</td>';
                    echo '<td>'.$cliente['cep'].'</td>';
                    echo '<td>'.$cliente['rg'].'</td>';
                    echo '<td>'.$cliente['endereco'].'</td>';
                    echo '<td>'.$cliente['cidade'].'</td>';
                    echo '<td>'.$cliente['n_endereco'].'</td>';
                    echo '<td>'.$cliente['status_cliente'].'</td>';
                    echo '<td>'.$cliente['bairro'].'</td>';
                    echo '<td>'.$cliente['tipo_pessoa'].'</td>';
                    echo '<td>'.$cliente['data'].'</td>';
                    echo '<td><a href="editar_cadastro_clientes.php?cod_cliente='.$cliente['cod_cliente'].'">Editar</a></td>';
                    echo '<td><a href="../php/delete_cliente.php?cod_cliente='.$cliente['cod_cliente'].'">Excluir</a></td>';
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
                <img src="../imagem/clientexxx-removebg-preview.png" alt="">
                <h3>Clientes</h3>
            </div>
        </div>
    </div>
    <div  style="color: red; font-size: 18px; z-index:999;transform:translate(100px, 220px);width:75vh;height:3vh;">
        <?php
        if(empty($_SESSION['mensagem'])){

        }else{
            echo "<div id='error' class='error'>".$_SESSION['mensagem']."</div>";
            unset($_SESSION['mensagem']);
        }
        ?>
    </div>
    <div  style="color: green; font-size: 18px; z-index:999;transform:translate(100px, 200px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['msm'])){

        }else{
            echo "<div id='sucess' class='error'>".$_SESSION['msm']."</div>";
            unset($_SESSION['msm']);
        }
        ?>
    </div>
    <div  style="color: green; font-size: 18px; z-index:999;transform:translate(100px, 180px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['salvar'])){

        }else{
            echo "<div id='save' class='error'>".$_SESSION['salvar']."</div>";
            unset($_SESSION['salvar']);
        }
        ?>
    </div>

    <div  style="color: red; font-size: 18px; z-index:999;transform:translate(100px, 158px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['inserir_error'])){

        }else{
            echo "<div id='insert_erro' class='error'>".$_SESSION['inserir_error']."</div>";
            unset($_SESSION['inserir_error']);
        }
        ?>
    </div>

    <div  style="color: green; font-size: 18px; z-index:999;transform:translate(100px, 139px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['update_cliente'])){

        }else{
            echo "<div id='update_sucess' class='error'>".$_SESSION['update_cliente']."</div>";
            unset($_SESSION['update_cliente']);
        }
        ?>
    </div>

    <div  style="color: green; font-size: 18px; z-index:999;transform:translate(100px, 117px);width:65vh;height:3vh;">
        <?php
        if(empty($_SESSION['error_edit'])){

        }else{
            echo "<div id='editerror' class='error'>".$_SESSION['error_edit']."</div>";
            unset($_SESSION['error_edit']);
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                setTimeout(function() {
                    $('#error').fadeOut('fast');
                }, 3000);
            });

            $(document).ready(function(){
                setTimeout(function() {
                    $('#sucess').fadeOut('fast');
                }, 3000);
            });

            $(document).ready(function(){
                setTimeout(function() {
                    $('#save').fadeOut('fast');
                }, 3000);
            });

            $(document).ready(function(){
                setTimeout(function() {
                    $('#insert_erro').fadeOut('fast');
                }, 3000);
            });

            $(document).ready(function(){
                setTimeout(function() {
                    $('#update_sucess').fadeOut('fast');
                }, 3000);
            });

            $(document).ready(function(){
                setTimeout(function() {
                    $('#editerror').fadeOut('fast');
                }, 3000);
            });
        </script>
</body>

</html>