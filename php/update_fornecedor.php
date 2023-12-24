<?php

session_start();
include('conexao.php');

    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $n_endereco = $_POST['n_endereco'];
    $bairro = $_POST['bairro'];
    $status_fornecedor = $_POST['status_fornecedor'];
    $cod_fornecedor = $_POST['cod_fornecedor'];


  // Verifica se o telefone contém somente números
  if (!ctype_digit($telefone)) {
    echo "<script>alert('O telefone só pode conter números!')</script>";
    die();
  }

  // Verifica se o CEP contém somente números
  if (!ctype_digit($cep)) {
    echo "<script>alert('O CEP só pode conter números!')</script>";
    die();
  }

    try{

        $query = $dbh->prepare('UPDATE fornecedor SET 
        telefone=:telefone, email=:email, cep=:cep, endereco=:endereco, cidade=:cidade, uf=:uf, n_endereco=:n_endereco, 
        bairro=:bairro, status_fornecedor=:status_fornecedor WHERE cod_fornecedor=:cod_fornecedor');

        $query->execute(array(
            ':telefone' => $telefone,
            ':email' => $email,
            ':cep' => $cep,
            ':endereco' =>$endereco,
            ':cidade' =>$cidade,
            ':uf' => $uf,
            ':n_endereco' => $n_endereco,
            ':bairro' => $bairro,
            ':status_fornecedor' => $status_fornecedor,
            ':cod_fornecedor' => $cod_fornecedor
        ));

        $_SESSION['sucesso_update'] = "Cadastro atualizado com sucesso!";
        header('Location: ../html/fornecedores.php');

    }catch(PDOException $e){
        $_SESSION['erro_update'] = "Cadastro não atualizado!";
        header('Location: ../html/fornecedores.php');
    }
?>