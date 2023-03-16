<?php

// Incluir o arquivo de conexão com o banco de dados
include("db_connect.php");

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit;
}

// Capturar o nome do usuário logado
$username = $_SESSION['username'];

// Buscar o usuário no banco de dados
$query = "SELECT * FROM usuario WHERE email = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$id =$user['id'];



if (isset($_POST['alterarDadosPessoais'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $queryVerifica = "SELECT * FROM usuario WHERE email = '$email'";
    $resultVerifica = mysqli_query($conn, $queryVerifica);
    if (mysqli_num_rows($resultVerifica) == 1) {
        echo  "<script>alert('Email já cadastrado!');</script>";
    } else{
    // Alterando os dados do usuário
    $sql = "UPDATE usuario SET nome='$nome', email='$email' WHERE id=$id";
    $resultado = mysqli_query($conn, $sql);
    
    if ($resultado) {
        echo  "<script>alert('Dados atualizando, realize novamente o login!');</script>";

        header('location: logout.php');
    } else {
        echo "Erro ao alterar os dados!";
    }
    }
}

if (isset($_POST['alterarSenha'])) {
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];

    if ($senha == $senha2) {
        $senha = md5($senha);
        $sql = "UPDATE usuario SET senha='$senha' WHERE id=$id";
        $resultado = mysqli_query($conn, $sql);
        if ($resultado) {
            echo "A senha foi alterada com sucesso!";
        } else {
            echo "Erro ao alterar a senha!";
        }
    } else {
        echo "As senhas não conferem!";
    }

  
}

if(isset($_POST['alterarEndereco'])){
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];

    $sql = "UPDATE usuario SET rua='$rua', numero='$numero', complemento='$complemento', bairro='$bairro' WHERE id=$id";
    
    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
        
        echo "O endereço foi alterado com sucesso!";
    } else {
        echo "Erro ao alterar o endereço!";
        
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Alterar dados cadastrais</h1>
    <h2>Dados Pessoais</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?php echo $user['nome']; ?>">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>">
        <input type="submit" name="alterarDadosPessoais" value="Alterar">
    </form>
    <h2>Senha</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">
        <label for="senha2">Confirmar senha</label>
        <input type="password" name="senha2" id="senha2">
        <input type="submit" name="alterarSenha" value="Alterar">
    </form>
    <h2>Endereço </h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="rua">Rua</label>
        <input type="text" name="rua" id="rua" value="<?php echo $user['rua']; ?>">
        <label for="numero">Número</label>
        <input type="text" name="numero" id="numero" value="<?php echo $user['numero']; ?>">
        <label for="complemento">Complemento</label>
        <input type="text" name="complemento" id="complemento" value="<?php echo $user['complemento']; ?>">
        <label for="bairro">Bairro</label>
        <input type="text" name="bairro" id="bairro" value="<?php echo $user['bairro']; ?>">
        <input type="submit" name="alterarEndereco" value="Alterar">
    </form>
</body>

</html>

