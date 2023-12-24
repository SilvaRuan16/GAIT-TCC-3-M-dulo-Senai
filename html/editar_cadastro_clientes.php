<?php
    include('../php/conexao.php');
    
    $cod_clientes = $_GET['cod_cliente'];
    $query = $dbh->prepare('SELECT * FROM cliente WHERE cod_cliente = :cod_cliente;');
    $query->execute(array(
        ':cod_cliente' => $cod_clientes
    ));
    
    $cliente = $query->fetch();

    $query = $dbh->prepare('SELECT * FROM clienteSTS');
    $query->execute();

    $status = $query->fetchAll();

    $squery = $dbh->prepare('SELECT * FROM pessoaTIPO');
    $squery->execute();

    $tipoPessoa = $squery->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/cadastro_clientes.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Editar Clientes</title>
</head>

<body>
    <form action="../php/update_cliente.php" method="post">
    <input type="hidden" name="cod_cliente" value="<?php echo $_GET['cod_cliente'];?>">
        <input type="submit" value="Editar">
        <div class="column-1">
           <label for="nome">Nome/ Fantasia</label>
           <input type="text" name="nome" id="nome" value="<?php echo $cliente['nome']; ?>" required> 
        </div>
        <div class="column-2">
            <label for="data_nascimento">Data Nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo $cliente['data_nascimento']; ?>" disabled>
        </div>
        <div class="column-3">
            <label for="cpf">CPF</label>
            <input type="tel" name="cpf" id="cpf" value="<?php echo $cliente['cpf']; ?>" disabled>
        </div>
        <div class="column-3-2">
            <label for="cnpj">CNPJ</label>
            <input type="tel" name="cnpj" id="cnpj" value="<?php echo $cliente['cnpj']; ?>" disabled>
        </div>
        <div class="column-4">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" value="<?php echo $cliente['telefone']; ?>" minlength="11" maxlength="11" required>
        </div>
        <div class="column-5">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $cliente['email']; ?>" minlength="1" maxlength="30" required>
        </div>
        <div class="column-6">
            <label for="cep">CEP</label>
            <input type="tel" name="cep" id="cep" value="<?php echo $cliente['cep']; ?>" minlength="8" maxlength="8" required>
        </div>
        <div class="column-7">
            <label for="rg">RG</label>
            <input type="tel" name="rg" id="rg" value="<?php echo $cliente['rg']; ?>" minlength="7" maxlength="7" disabled>
        </div>
        <div class="column-8">
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="endereco" value="<?php echo $cliente['endereco']; ?>" minlength="1" maxlength="50" required>
        </div>
        <div class="column-9">
            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" id="cidade" value="<?php echo $cliente['cidade']; ?>" minlength="1" maxlength="50" required>
        </div>
        <div class="column-10">
            <label for="n_endereco">Nº endereço</label>
            <input type="tel" name="n_endereco" id="n_endereco" value="<?php echo $cliente['n_endereco']; ?>" required>
        </div>
        <div class="column-11">
            <label for="bairro">Bairro</label>
            <input type="text" name="bairro" id="bairro" value="<?php echo $cliente['bairro']; ?>" minlength="1" maxlength="50" required>
        </div>
        <div class="column-12">
            <label for="status_cliente">Status cliente</label>
            <select name="status_cliente" id="status_cliente" required>
                <?php
                    foreach($status as $status){
                        $sts = '';
                        if($status['cod'] == $cliente['status_cliente']){
                            $sts = 'selected';
                        }
                        echo '<option value="'.$status['cod'].'" '.$sts.'>'.$status['sts'].'</option>';
                        
                    }
                ?>
            </select>
        </div>
        <div class="column-13">
            <label for="tipo_pessoa">Tipo Pessoa</label>
            <select name="tipo_pessoa" id="tipo_pessoa" required>
                <?php
                    foreach($tipoPessoa as $tipoPessoa){
                        $tip = '';
                        if($tipoPessoa['cod'] == $cliente['tipo_pessoa']){
                            $tip = 'selected';
                        }
                        echo '<option value="'.$tipoPessoa['cod'].'" '.$tip.'>'.$tipoPessoa['tipo'].'</option>';
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
                <img src="../imagem/clientexxx-removebg-preview.png" alt="">
                <h3>Clientes</h3>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="index.js"></script>
</body>

</html>