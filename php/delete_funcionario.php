<?php

    session_start();
    include('conexao.php');

    $cod_funcionario = $_GET['cod_funcionario'];

    try{
        $query = $dbh->prepare('DELETE FROM funcionario WHERE cod_funcionario = :cod_funcionario');

        $query->execute(array(
            ':cod_funcionario' => $cod_funcionario
        ));

        $_SESSION['sucesso_excluir'] = "Cadastro excluído com sucesso!";
        header('Location: ../html/funcionarios.php');

    }catch(PDOException $e){

        $_SESSION['erro_excluir'] = "Cadastro não excluido!";
        header('Location: ../html/funcionarios.php');
    }
?>