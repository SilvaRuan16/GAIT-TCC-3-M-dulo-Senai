<?php

    session_start();
    include('conexao.php');

        $nome = $_POST['nome'];
        //$data_nascimento = $_POST['data_nascimento'];
        //$cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $cep = $_POST['cep'];
        //$rg = $_POST['rg'];
        $endereco = $_POST['endereco'];
        $cidade = $_POST['cidade'];
        $n_endereco = $_POST['n_endereco'];
        $bairro = $_POST['bairro'];
        $status_funcionario = $_POST['status_funcionario'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $cod_funcionario = $_POST['cod_funcionario'];

        if (!ctype_digit($telefone)) {
            echo "<script>alert('O telefone só pode conter números!')</script>";
            die();
          }
          
          if (!ctype_digit($cep)) {
            echo "<script>alert('O CEP só pode conter números!')</script>";
            die();
          }

    try{

        $query = $dbh->prepare('UPDATE funcionario SET nome =:nome, telefone=:telefone, email=:email, cep=:cep, endereco=:endereco, cidade=:cidade, n_endereco=:n_endereco, bairro=:bairro, status_funcionario=:status_funcionario, usuario=:usuario, senha=:senha WHERE cod_funcionario=:cod_funcionario');

        $query->execute(array(

            ':nome' => $nome,
            //':data_nascimento' => $data_nascimento,
            //':cpf' => $cpf,
            ':telefone' => $telefone,
            ':email' => $email,
            ':cep' => $cep,
            //':rg' => $rg,
            ':endereco' => $endereco,
            ':cidade' => $cidade,
            ':n_endereco' => $n_endereco,
            ':bairro' => $bairro,
            ':status_funcionario' => $status_funcionario,
            ':usuario' => $usuario,
            ':senha' => $senha,
            ':cod_funcionario' => $cod_funcionario

        ));

        $_SESSION['sucesso_cadastro'] = "Cadastro atualizado com sucesso!";
        header('Location: ../html/funcionarios.php');

    }catch(PDOException $e){

        $_SESSION['erro_update'] = "Cadastro não atualizado!";
        header('Location: ../html/funcionarios.php');
    }

?>