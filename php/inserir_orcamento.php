<?php

session_start();
include('conexao.php');

    if(isset($_POST['pedido'], $_POST['valor'], $_POST['forma_pagamento'], $_POST['descricao'], $_POST['status_venda'], $_POST['status_orcamento']) && ($_POST['pedido']!='') && ($_POST['valor']!='') && ($_POST['forma_pagamento']!='') && ($_POST['descricao']!='') && ($_POST['status_venda']!='') && ($_POST['status_orcamento'])){
        $id_cliente = $_POST['id_cliente'];
        $pedido = $_POST['pedido'];
        $valor = $_POST['valor'];
        $forma_pagamento = $_POST['forma_pagamento'];
        $descricao = $_POST['descricao'];
        $status_venda = $_POST['status_venda'];
        $status_orcamento = $_POST['status_orcamento'];

        if (!preg_match('/[0-9.]+/', $valor)) {
            echo "<script>alert('O valor só pode conter números ou ponto!')</script>";
            die();
          }

    try{
        $query = $dbh->prepare('INSERT INTO orcamento (id_cliente, forma_pagamento, valor, status_venda, status_orcamento, descricao, pedido) 
        VALUES (:id_cliente, :forma_pagamento, :valor, :status_venda, :status_orcamento, :descricao, :pedido);');

        $query->execute(array(
            ':id_cliente' => $id_cliente,
            ':pedido' => $pedido,
            ':valor' => $valor,
            ':forma_pagamento' => $forma_pagamento,
            ':descricao' => $descricao,
            ':status_venda' => $status_venda,
            ':status_orcamento' => $status_orcamento
        ));

        $_SESSION['inserir_sucesso'] = "Cadastrado com sucesso!";
        header('Location: ../html/orcamentos.php');

    }catch(PDOException $e){

        $_SESSION['inserir_erro'] = "Cadastro não realizado!";
        header('Location: ../html/orcamentos.php');
    }
}

?>