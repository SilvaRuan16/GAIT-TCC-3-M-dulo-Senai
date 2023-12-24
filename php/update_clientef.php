<?php

session_start();
    include('conexao.php');

            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $cep = $_POST['cep'];
            $endereco = $_POST['endereco'];
            $cidade = $_POST['cidade'];
            $n_endereco = $_POST['n_endereco'];
            $status_cliente = $_POST['status_cliente'];
            $bairro = $_POST['bairro'];
            $cod_cliente = $_POST['cod_cliente'];

    try{

        $query = $dbh->prepare('UPDATE cliente SET nome=:nome, telefone=:telefone, email=:email, 
        cep=:cep, endereco=:endereco, cidade=:cidade, n_endereco=:n_endereco, status_cliente=:status_cliente, bairro=:bairro WHERE cod_cliente=:cod_cliente');

        $query->execute(array(
            ':nome' => $nome,
            ':telefone' => $telefone,
            ':email' => $email,
            ':cep' => $cep,
            ':endereco' => $endereco,
            ':cidade' => $cidade,
            ':n_endereco' => $n_endereco,
            ':status_cliente' => $status_cliente,
            ':bairro' => $bairro,
            ':cod_cliente' => $cod_cliente
        ));
        
        $_SESSION['update_sucesso'] = "Cadastro atualizado com sucesso!";
        header('Location: ../html/clientef.php');
        
    }catch(PDOException $e){

        $_SESSION['update_erro'] = "Cadastro não atualizado!";
        header('Location: ../html/clientef.php');
    }
?>