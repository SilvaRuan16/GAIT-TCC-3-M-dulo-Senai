<?php
    session_start();
    include('conexao.php');

    if(isset($_POST['nome'], $_POST['data_nascimento'], $_POST['cpf'], $_POST['cnpj'], $_POST['telefone'], $_POST['email'], $_POST['cep'], $_POST['rg'],$_POST['endereco'], $_POST['cidade'], $_POST['n_endereco'], $_POST['bairro']) && ($_POST['nome']!='') && ($_POST['cpf']!='') && ($_POST['telefone']!='') && ($_POST['email']!='') && ($_POST['cep']!='')){

        $nome = $_POST['nome'];
        $data_nascimento = $_POST['data_nascimento'];
        $cpf = $_POST['cpf'];
        $cnpj = $_POST['cnpj'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $cep = $_POST['cep'];
        $rg = $_POST['rg'];
        $endereco = $_POST['endereco'];
        $cidade = $_POST['cidade'];
        $n_endereco = $_POST['n_endereco'];
        $status_cliente = $_POST['status_cliente'];
        $bairro = $_POST['bairro'];
        $tipo_pessoa = $_POST['tipo_pessoa'];

        if (!ctype_digit($cpf)) {
            echo "<script>alert('O CPF só pode conter números!')</script>";
            die();
          }
        
          // Verifica se o telefone contém somente números
          if (!ctype_digit($telefone)) {
            echo "<script>alert('O telefone só pode conter números!')</script>";
            die();
          }
        
          // Verifica se o CEP contém somente números
          if (!ctype_digit($cep)) {
            echo "<script>alert('O CEP só pode conter números!')</script>";
            die();
          }

          if (!ctype_digit($rg)) {
            echo "<script>alert('O RG só pode conter números!')</script>";
            die();
          }

          if (!ctype_digit($n_endereco)) {
            echo "<script>alert('O Nº endereço só pode conter números!')</script>";
            die();
          }


    try{
        $query = $dbh->prepare('INSERT INTO cliente(nome, data_nascimento, cpf, cnpj, telefone, email, cep, rg, endereco, cidade, n_endereco,status_cliente, bairro, tipo_pessoa)VALUES(:nome, :data_nascimento, :cpf, :cnpj, :telefone, :email, :cep, :rg, :endereco, :cidade, :n_endereco,:status_cliente, :bairro, :tipo_pessoa)');

        $query->execute(array(

            ':nome' => $nome,
            ':data_nascimento' => $data_nascimento,
            ':cpf' => $cpf,
            ':cnpj' => $cnpj,
            ':telefone' => $telefone,
            ':email' => $email,
            ':cep' => $cep,
            ':rg' => $rg,
            ':endereco' => $endereco,
            ':cidade' => $cidade,
            ':n_endereco' => $n_endereco,
            ':status_cliente' => $status_cliente,
            ':bairro' => $bairro,
            ':tipo_pessoa' => $tipo_pessoa

        ));

        /*
        $_SESSION['salvar'] = "Cadastro inserido com sucesso!";
        header('Location: ../html/clientes.php');
        */
        //header('location: ./js-redirection/inserir_cliente.js');

        // Remover cabeçalhos de redirecionamento
        header("Content-Type: application/json");
        header("Access-Control-Allow-Origin: *");

        // Executar a lógica de cadastro
        ...

        // Enviar resposta
        echo json_encode(["sucesso" => true]);


    }catch(PDOException $e){
        
      /*
        $_SESSION['inserir_error'] = "Ops! cadastro não realizado!";
        header('Location: ../html/clientes.php');
      */
      echo json_encode(["falha" => false]);
    }

}
?>