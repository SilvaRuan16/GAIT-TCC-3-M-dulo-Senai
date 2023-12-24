<?php
include('../php/conexao.php');

$squery = $dbh->prepare('select * from statusProduto');
$squery->execute();

$status_produto = $squery->fetchAll();

$query = $dbh->prepare('select * from categoriaProduto');
$query->execute();

$categoria = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/cadastro_produtof.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Cadastro produto</title>
</head>

<body>
    <form action="../php/inserir_produtof.php" method="post">
        <input type="submit" value="Salvar">
        <div class="column-2">
            <label for="nome_produto">Nome produto</label>
            <input type="text" name="nome_produto" id="nome_produto" minlength="1" maxlength="50" required>
        </div>
        <div class="column-3">
            <label for="valor">Valor</label>
            <input type="tel" name="valor" id="valor" minlength="1" required>
        </div>
        <div class="column-4">
            <label for="quantidade">Quantidade</label>
            <input type="tel" name="quantidade" id="quantidade" minlength="1" required>
        </div>
        <div class="column-5">
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" required>
                <?php
                    foreach($categoria as $categoria){
                        echo '<option value="'.$categoria['cod'].'">'.$categoria['cat'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="column-6">
            <label for="status_produto">Status produto</label>
            <select name="status_produto" id="status_produto" required>
            <?php
                foreach($status_produto as $status){
                    echo '<option value="'.$status['cod'].'">'.$status['sts'].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="column-7">
            <label for="descricao">Descrição</label>
            <input name="descricao" id="descricao" minlength="1" maxlength="200" required></input>
        </div>
        <div class="column-8">
            <label for="observacao">observacao</label>
            <input name="observacao" id="observacao"></input>
        </div>
    </form>

    <div class="main">
        <div class="navbar">
            <div class="logo">
                <button><a href="index.php"><img class="imagem-logo" src="../imagem/SOFTWARE-GAIT-LOGO.png"
                            alt=""></a></button>
            </div>
            <nav>
                <a class="link" href="iniciof.html">Inicio</a>
                <a class="link" href="orcamentof.php">Orçamento</a>
                <a class="link" href="estoquef.php">Estoque</a>
                <a class="link" href="clientef.php">Clientes</a>
            </nav>
            <div class="local">
                <img src="../imagem/estoque-icon-removebg-preview.png" alt="">
                <h3>Produto</h3>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>