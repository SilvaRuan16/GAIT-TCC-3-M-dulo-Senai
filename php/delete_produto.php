<?php

    session_start();
    include('conexao.php');

    $cod_produto = $_GET['cod_produto'];

    try{
        $query = $dbh->prepare('DELETE FROM produto WHERE cod_produto = :cod_produto');

        $query->execute(array(
            ':cod_produto' => $cod_produto
        ));

        $_SESSION['delete_sucesso'] = "Cadastro excluido com sucesso!";
        header('Location: ../html/estoque.php');

    }catch(PDOException $e){
        $_SESSION['delete_erro'] = "Cadastro não excluido!";
        header('Location: ../html/estoque.php');
    }
?>