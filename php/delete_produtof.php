<?php
    include('conexao.php');

    $cod_produto = $_GET['cod_produto'];
    $query = $dbh->prepare('DELETE FROM produto WHERE cod_produto = :cod_produto');

    $query->execute(array(
        ':cod_produto' => $cod_produto
    ));

    header('Location: ../html/estoquef.php');
    echo "<script>alert('Excluido com sucesso!')</script>";
?>