<?php

session_start();
include('conexao.php');

if(isset($_POST['nome_fantasia'], $_POST['razao_social'], $_POST['cnpj'], $_POST['telefone'], $_POST['email'], $_POST['cep'], $_POST['endereco'], $_POST['cidade'], $_POST['uf'], $_POST['n_endereco'], $_POST['bairro'], $_POST['status_fornecedor']) && ($_POST['nome_fantasia']!='') && ($_POST['razao_social']!='') && ($_POST['cnpj']!='') && ($_POST['telefone']!='') && ($_POST['email']!='') && ($_POST['cep']!='')){

    $nome_fantasia = $_POST['nome_fantasia'];
    $razao_social = $_POST['razao_social'];
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $n_endereco = $_POST['n_endereco'];
    $bairro = $_POST['bairro'];
    $status_fornecedor = $_POST['status_fornecedor'];

  // Verifica se o CNPJ contém somente números
  if (!ctype_digit($cnpj)) {
    echo "<script>alert('O CNPJ só pode conter números!')</script>";
    die();
  }

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
    $query = $dbh->prepare('INSERT INTO fornecedor(nome_fantasia, razao_social, cnpj, telefone, email, cep, endereco, cidade, uf, n_endereco, bairro, status_fornecedor)VALUES(:nome_fantasia, :razao_social, :cnpj, :telefone, :email, :cep, :endereco, :cidade, :uf, :n_endereco, :bairro, :status_fornecedor)');

    $query->execute(array(

        ':nome_fantasia' => $nome_fantasia,
        ':razao_social' => $razao_social,
        ':cnpj' => $cnpj,
        ':telefone' => $telefone,
        ':email' => $email,
        ':cep' => $cep,
        ':endereco' => $endereco,
        ':cidade' => $cidade,
        ':uf' => $uf,
        ':n_endereco' => $n_endereco,
        ':bairro' => $bairro,
        ':status_fornecedor' => $status_fornecedor

    ));

    $_SESSION['cadastrado'] = "Cadastro inserido com sucesso!";
    header('Location: ../html/fornecedores.php');

    }catch(PDOException $e){

        $_SESSION['erro_cadastro'] = "Cadastro não realizado!";
        header('Location: ../html/fornecedores.php');
    }
}
?>