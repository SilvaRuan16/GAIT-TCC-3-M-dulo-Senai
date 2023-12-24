<?php

session_start();
    include ('conexao.php');
    
    //$nome = $_POST['nome_produto'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];
    //$categoria = $_POST['categoria'];
    $status_produto = $_POST['status_produto'];
    $descricao = $_POST['descricao'];
    $observacao = $_POST['observacao'];
    $cod_produto = $_POST['cod_produto'];

    if (!ctype_digit($quantidade)) {
        echo "<script>alert('A quantidade só pode conter números!')</script>";
        die();
      }
    
      if (!preg_match('/[0-9.]+/', $valor)) {
        echo "<script>alert('O valor só pode conter números ou ponto!')</script>";
        die();
      }

    try{
        $query = $dbh->prepare('UPDATE produto SET descricao = :descricao, quantidade = :quantidade, valor = :valor, status_produto = :status_produto, observacoes = :observacoes WHERE cod_produto = :cod_produto;');

        $query->execute(array(
            //':nome_produto' => $nome,
            ':descricao' => $descricao,
            ':quantidade' => $quantidade,
            ':valor' => $valor,
            ':status_produto' => $status_produto,
            //':categoria' => $categoria,
            ':observacoes' => $observacao,
            ':cod_produto' => $cod_produto
        ));

        $_SESSION['update_sucesso'] = "Cadastro atualizado com sucesso!";
        header('Location: ../html/estoque.php');
    }catch(PDOException $e){

        $_SESSION['update_erro'] = "Cadastro não atualizado!";
        header('Location: ../html/estoque.php');
    }
?>