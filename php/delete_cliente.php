<?php

    session_start();
    include('conexao.php');

    $cod_cliente = $_GET['cod_cliente'];
    try{
        $query = $dbh->prepare('DELETE FROM cliente WHERE cod_cliente = :cod_cliente');

        $query->execute(array(
            ':cod_cliente' => $cod_cliente
        ));

        $_SESSION['msm'] = "Cadastro excluído com sucesso!";
        header('Location: ../html/clientes.php');

    }catch(PDOException $e){

        $_SESSION['mensagem'] = "Este cliente possui orçamentos cadastrados, você deve exclui-los";
        header('Location: ../html/clientes.php');
    }
?>