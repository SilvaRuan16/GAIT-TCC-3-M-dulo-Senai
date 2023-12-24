<?php

    session_start();
    include('conexao.php');

    $cod_materia = $_GET['cod_materia'];

    try{
        $query = $dbh->prepare('DELETE FROM materia_prima WHERE cod_materia = :cod_materia');

        $query->execute(array(
            ':cod_materia' => $cod_materia
        ));


        $_SESSION['delete_sucesso'] = "Cadastro excluido com sucesso!";
        header('Location: ../html/materiaprima.php');

    }catch(PDOException $e){

        $_SESSION['delete_erro'] = "Cadastro não excluido!";
        header('Location: ../html/materiaprima.php');
    }
?>