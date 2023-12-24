<?php
    include('../php/conexao.php');

    $query = $dbh->prepare('SELECT * FROM  funcionarioStatus');
    $query->execute();

    $funcionario = $query->fetchAll();

    $cod_funcionario = $_GET['cod_funcionario'];
    $query_origin = $dbh->prepare('SELECT * FROM funcionario WHERE cod_funcionario = :cod_funcionario');

    $query_origin->execute(array(
        ':cod_funcionario' => $cod_funcionario
    ));

    $funcionario_origin = $query_origin->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/editar_funcionario.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Editar Funcionários</title>
</head>

<body>
    <form action="../php/update_funcionario.php" method="post">
    <input type="hidden" name="cod_funcionario" value="<?php echo $_GET['cod_funcionario'];?>">
        <input type="submit" value="Editar">
        <div class="column-1">
           <label for="nome">Nome</label>
           <input type="text" name="nome" id="nome" value="<?php echo $funcionario_origin['nome']; ?>" minlength="3" maxlength="60" required> 
        </div>
        <div class="column-2">
            <label for="data_nascimento">Data nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo $funcionario_origin['data_nascimento']; ?>" disabled>
        </div>
        <div class="column-3">
            <label for="cpf">CPF</label>
            <input type="tel" name="cpf" id="cpf" value="<?php echo $funcionario_origin['cpf']; ?>" minlength="11" maxlength="11" disabled>
        </div>
        <div class="column-4">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" value="<?php echo $funcionario_origin['telefone']; ?>" minlength="11" maxlength="11" required>
        </div>
        <div class="column-5">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $funcionario_origin['email']; ?>" minlength="1" maxlength="60" required>
        </div>
        <div class="column-6">
            <label for="cep">CEP *</label>
            <input type="tel" name="cep" id="cep" value="<?php echo $funcionario_origin['cep']; ?>" minlength="8" maxlength="8" required>
        </div>
        <div class="column-7">
            <label for="rg">RG</label>
            <input type="tel" name="rg" id="rg" value="<?php echo $funcionario_origin['rg']; ?>" minlength="7" maxlength="7" disabled>
        </div>
        <div class="column-8">
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="endereco" value="<?php echo $funcionario_origin['endereco']; ?>" minlength="1" maxlength="50" required>
        </div>
        <div class="column-9">
            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" id="cidade" value="<?php echo $funcionario_origin['cidade']; ?>" minlength="1" maxlength="50" required>
        </div>
        <div class="column-10">
            <label for="n_endereco">Nº endereço</label>
            <input type="text" name="n_endereco" id="n_endereco" value="<?php echo $funcionario_origin['n_endereco']; ?>" required>
        </div>
        <div class="column-11">
            <label for="bairro">Bairro</label>
            <input type="text" name="bairro" id="bairro" value="<?php echo $funcionario_origin['bairro']; ?>" minlength="1" maxlength="50" required>
        </div>
        <div class="column-12">
            <label for="status_funcionario">Status funcionário</label>
            <select name="status_funcionario" id="status_funcionario" required>
                <?php
                    foreach($funcionario as $f){
                        $status = '';
                        if($f['cod'] == $funcionario_origin['status_funcionario']){
                            $status = 'selected';
                        }
                        echo '<option value="'.$f['cod'].'" '.$status.'>'.$f['sts'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="column-13">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" value="<?php echo $funcionario_origin['usuario']; ?>" minlength="1" maxlength="25" required>
        </div>
        <div class="column-14">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" value="<?php echo $funcionario_origin['senha']; ?>" minlength="1" maxlength="6" required>
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
                <img src="../imagem/funcionario-icon-removebg-preview.png" alt="">
                <h3>Funcionários</h3>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="index.js"></script>
</body>

</html>