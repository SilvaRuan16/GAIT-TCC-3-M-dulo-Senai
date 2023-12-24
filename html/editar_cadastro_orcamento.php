<?php
    include('../php/conexao.php');

    $query = $dbh->prepare('SELECT * FROM pagForma');
    $query->execute();
    $formaPagamento = $query->fetchAll();

    $query1 = $dbh->prepare('SELECT * FROM cliente');
    $query1->execute();
    $cliente = $query1->fetchAll();

    $query1 = $dbh->prepare('SELECT * FROM pTIPO');
    $query1->execute();
    $tipoPessoa = $query1->fetchAll();

    $query2 = $dbh->prepare('SELECT * FROM vendaSTATUS');
    $query2->execute();
    $statusVenda = $query2->fetchAll();

    $query3 = $dbh->prepare('SELECT * FROM orcamentoSTATUS');
    $query3->execute();
    $statusOrcamento = $query3->fetchAll();

    $cod_orcamento = $_GET['cod_orcamento'];    
    $query_origin = $dbh->prepare('SELECT * FROM orcamento WHERE cod_orcamento = :cod_orcamento');

    $query_origin->execute(array(
        ':cod_orcamento' => $cod_orcamento
    ));
    $orcamento = $query_origin->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/cadastro_orcamento.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Editar Orçamento</title>
</head>

<body>
    <form action="../php/update_orcamento.php" method="post">
    <input type="hidden" name="cod_orcamento" value="<?php echo $_GET['cod_orcamento'];?>">
    <input type="submit" value="Editar">
    <div class="c1">
            <label for="nome_fantasia">Nome/ Fantasia</label>
            <select name="id_cliente" id="nome_fantasia" disabled>
                <?php
                    foreach($cliente as $cliente){
                        $co = ''; // --> Cliente || Cadastro Orçamento
                        if($cliente['cod_cliente'] == $orcamento['id_cliente']){
                            $co = 'selected';
                        }
                        echo '<option value="'.$cliente['cod_cliente'].'" '.$co.'>'.$cliente['nome'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="c2">
            <label for="pedido">Pedido</label>
            <input name="pedido" id="pedido" value="<?php echo $orcamento['pedido']; ?>" minlength="1" maxlength="200">
        </div>
        <div class="c3">
            <label for="valor">Valor</label>
            <input type="tel" name="valor" id="valor" value="<?php echo $orcamento['valor']; ?>" minlength="1">
        </div>
        <div class="c4">
            <label for="forma_pagamento">Forma pagamento</label>
            <select name="forma_pagamento" id="forma_pagamento">
                <?php
                    foreach($formaPagamento as $forma){
                        $fp = ''; // Forma pagamento

                        if($forma['cod'] == $orcamento['forma_pagamento']){
                            $fp = 'selected';
                        }
                        echo '<option value="'.$forma['cod'].'" '.$fp.'>'.$forma['forma'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="c5">
            <label for="descricao">Descrição</label>
            <input name="descricao" id="descricao" value="<?php echo $orcamento['descricao']; ?>" minlength="1" maxlength="200"></input>
        </div>
        <div class="c6">
            <label for="status_venda">Status venda</label>
            <select name="status_venda" id="status_venda">
                <?php
                    foreach($statusVenda as $statusVenda){
                        echo '<option value="'.$statusVenda['cod'].'">'.$statusVenda['sts'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="c7">
        <label for="status_orcamento">Status orçamento</label>
            <select name="status_orcamento" id="status_orcamento">
                <?php
                    foreach($statusOrcamento as $statusOrcamento){
                        echo '<option value="'.$statusOrcamento['cod'].'">'.$statusOrcamento['sts'].'</option>';
                    }
                ?>
            </select>
        </div>
    </form>

    <div class="main">
        <div class="navbar">
            <div class="logo">
                <button><a href="index.php"><img class="imagem-logo" src="../imagem/SOFTWARE-GAIT-LOGO.png"
                            alt=""></a></button>
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
            <img src="../imagem/icone-orcamentos-removebg-preview.png" alt="">
                <h3>Orçamentos</h3>
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>