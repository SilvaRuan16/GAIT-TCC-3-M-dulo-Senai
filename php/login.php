<?php
session_start();
include('conexao.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

if(empty($usuario) || empty($senha)){
  echo "<script>alert('Campos obrigadorios não preenchidos!')</script>";
  //header('location: ../login.php');
}else{

  try{
    $query = $dbh->prepare("SELECT cod_funcionario, usuario, senha, status_funcionario, adm FROM funcionario WHERE usuario=:usuario AND senha=:senha;");
    $query->execute(array(
      ':usuario' => $usuario,
      ':senha' => $senha
    ));

    $resultado = $query->fetch();

    if(empty($resultado)){
      $_SESSION['falha'] = "Usuario ou senha inválida!";
      header('Location: ../html/index.php');
    }else{
      if($resultado['status_funcionario'] == 'Desativado'){
        $_SESSION['falha'] = "Funcionario desativado!";
        header('Location: ../html/index.php');
      }else{
        if($resultado['status_funcionario'] == 'Ativo'){
          header('location: ../html/iniciof.html');
        }
      }

      if($resultado['adm'] == TRUE){
        header('location: ../html/inicio.html');
      }
    }

  }catch(PDOException $e){
    echo $e;
  }
}
?>
