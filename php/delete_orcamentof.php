<?php
    include('conexao.php');

    $cod_orcamento = $_GET['cod_orcamento'];
    $query = $dbh->prepare('DELETE FROM orcamento WHERE cod_orcamento = :cod_orcamento');

    $query->execute(array(
        ':cod_orcamento' => $cod_orcamento
    ));

    header('Location: ../html/orcamentof.php');
    echo "<script>alert('Excluido com sucesso!')</script>";
?>

