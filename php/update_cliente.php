<?php
    session_start();
    include('conexao.php');

            $nome = $_POST['nome'];
            //$data_nascimento = $_POST['data_nascimento'];
            //$cnpj = $_POST['cnpj'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $cep = $_POST['cep'];
            $endereco = $_POST['endereco'];
            $cidade = $_POST['cidade'];
            $n_endereco = $_POST['n_endereco'];
            $status_cliente = $_POST['status_cliente'];
            $bairro = $_POST['bairro'];
            $tipo_pessoa = $_POST['tipo_pessoa'];
            $cod_cliente = $_POST['cod_cliente'];
    
              if (!ctype_digit($telefone)) {
                echo "<script>alert('O telefone só pode conter números!')</script>";
                die();
              }
            
              // Verifica se o CEP contém somente números
              if (!ctype_digit($cep)) {
                echo "<script>alert('O CEP só pode conter números!')</script>";
                die();
              }
              
              if (!ctype_digit($n_endereco)) {
                echo "<script>alert('O Nº endereço só pode conter números!')</script>";
                die();
              }

    try{

        $query = $dbh->prepare('UPDATE cliente SET nome=:nome, telefone=:telefone, email=:email, 
        cep=:cep, endereco=:endereco, cidade=:cidade, n_endereco=:n_endereco, status_cliente=:status_cliente, bairro=:bairro, tipo_pessoa=:tipo_pessoa WHERE cod_cliente=:cod_cliente');

        $query->execute(array(
            ':nome' => $nome,
            //':data_nascimento' => $data_nascimento,
            //':cnpj' => $cnpj,
            ':telefone' => $telefone,
            ':email' => $email,
            ':cep' => $cep,
            ':endereco' => $endereco,
            ':cidade' => $cidade,
            ':n_endereco' => $n_endereco,
            ':status_cliente' => $status_cliente,
            ':bairro' => $bairro,
            ':tipo_pessoa' => $tipo_pessoa,
            ':cod_cliente' => $cod_cliente
        ));

        $_SESSION['update_cliente'] = "Cadastro atualizado com sucesso!";
        header('Location: ../html/clientes.php');

    }catch(PDOException $e){
        //echo 'erro ao executar query : -> ' .$e;
        $_SESSION['error_edit'] = "Cadastro não atualizado!";
        header('Location: ../html/clientes.php');
    }
?>