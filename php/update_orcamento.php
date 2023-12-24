<?php

session_start();
include('conexao.php');

    //$nome = $_POST['id_cliente'];
    $forma_pagamento = $_POST['forma_pagamento'];
    $valor = $_POST['valor'];
    $status_venda = $_POST['status_venda'];
    $status_orcamento = $_POST['status_orcamento'];
    $pedido = $_POST['pedido'];
    $descricao = $_POST['descricao'];
    $cod_orcamento = $_POST['cod_orcamento'];

    if (!preg_match('/[0-9.]+/', $valor)) {
        echo "<script>alert('O valor só pode conter números ou ponto!')</script>";
        die();
      }

    try{
        $query = $dbh->prepare('UPDATE orcamento SET forma_pagamento=:forma_pagamento, valor=:valor, status_venda=:status_venda, status_orcamento=:status_orcamento, pedido=:pedido, descricao=:descricao WHERE cod_orcamento=:cod_orcamento');
        $query->execute(array(

            ':forma_pagamento' => $forma_pagamento,
            ':valor' => $valor,
            ':status_venda' => $status_venda,
            ':status_orcamento' => $status_orcamento,
            ':pedido' => $pedido,
            ':descricao' => $descricao,
            ':cod_orcamento' => $cod_orcamento
        ));
        
        $_SESSION['update_sucesso'] = "Cadastro atualizado com sucesso!";
        header('Location: ../html/orcamentos.php');
    }catch(PDOException $e){

        $_SESSION['update_erro'] = "Cadastro não atualizado!";
        header('Location: ../html/orcamentos.php');
    }
?>

