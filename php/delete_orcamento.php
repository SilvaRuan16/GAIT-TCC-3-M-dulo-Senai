<?php

session_start();
    include('conexao.php');

    $cod_orcamento = $_GET['cod_orcamento'];

    try{
    $query = $dbh->prepare('DELETE FROM orcamento WHERE cod_orcamento = :cod_orcamento');

    $query->execute(array(
        ':cod_orcamento' => $cod_orcamento
    ));


        $_SESSION['delete_sucesso'] = "Cadastro excluido com sucesso!";
        header('Location: ../html/orcamentos.php');
    }catch(PDOException $e){


        $_SESSION['delete_erro'] = "Cadastro não excluido!";
        header('Location: ../html/orcamentos.php');
    }
?>