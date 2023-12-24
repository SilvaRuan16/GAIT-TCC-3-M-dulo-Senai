<?php

    session_start();
    include('conexao.php');

    $cod_fornecedor = $_GET['cod_fornecedor'];

    try{
    $query = $dbh->prepare('DELETE FROM fornecedor WHERE cod_fornecedor = :cod_fornecedor');

    $query->execute(array(
        ':cod_fornecedor' => $cod_fornecedor
    )); 

    $_SESSION['sucesso_delete'] = "Cadastro excluído com sucesso!";
    header('Location: ../html/fornecedores.php');

}catch(PDOException $e){
    $_SESSION['erro_delete'] = "Cadastro não excluido!";
    header('Location: ../html/fornecedores.php');
}
?>