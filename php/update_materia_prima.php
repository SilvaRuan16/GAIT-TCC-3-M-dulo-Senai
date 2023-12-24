<?php

    session_start();
    include('conexao.php');

        //$nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $valor = $_POST['valor'];
        $status = $_POST['status'];
        //$categoria = $_POST['categoria'];
        $observacao = $_POST['observacao'];
        $cod_materia = $_POST['cod_materia'];

        if (!ctype_digit($quantidade)) {
            echo "<script>alert('A quantidade só pode conter números!')</script>";
            die();
          }
        
          if (!preg_match('/[0-9.]+/', $valor)) {
            echo "<script>alert('O valor só pode conter números ou ponto!')</script>";
            die();
          }

    try{

        $query = $dbh->prepare('UPDATE materia_prima SET descricao=:descricao, quantidade=:quantidade, valor=:valor, status=:status, observacao=:observacao WHERE cod_materia=:cod_materia;');

        $query->execute(array(

            //':nome' => $nome,
            ':descricao' => $descricao,
            ':quantidade' => $quantidade,
            ':valor' => $valor,
            ':status' => $status,
            //':categoria' => $categoria,
            ':observacao' => $observacao,
            ':cod_materia' => $cod_materia

        ));
        
        $_SESSION['update_sucesso'] = "Cadastro atualizado com sucesso!";
        header('Location: ../html/materiaprima.php');

    }catch(PDOException $e){
        
        $_SESSION['update_erro'] = "Cadastro não atualizado!";
        header('Location: ../html/materiaprima.php');
    }

?>