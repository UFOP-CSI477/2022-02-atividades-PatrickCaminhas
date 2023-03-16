<?php

$dbhost = 'localhost'; // endereço do servidor de banco de dados
$dbuser = 'root'; // usuário do banco de dados
$dbpass = ''; // senha do usuário do banco de dados
$dbname = 'lanchonete'; // nome do banco de dados

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$con) {
    die('Não foi possível conectar: ' . mysqli_error($con));
}

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];

    $query = "SELECT * FROM usuario WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
        echo  "<script>alert('Email já cadastrado!');</script>";
    } else {

        $sql = "INSERT INTO usuario (nome, email, senha,rua,numero,complemento,bairro)
    VALUES ('$nome', '$email', '$senha','$rua','$numero','$complemento','$bairro')";

        if (mysqli_query($con, $sql)) {
            echo "Usuário cadastrado com sucesso!";
            header('location: index.php');
        } else {
            echo  "<script>alert('Erro ao cadastrar usuario!');</script>";
            header('location: cardapio.php');
        }
    }
}
?>


<html>

<head>
    <title>Cadastro de usuário</title>
</head>

<body>
    <h1>Cadastro de usuário</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h3>Dados Pessoais</h3>
        Nome: <input type="text" name="nome" /><br />
        Email: <input type="email" name="email" /><br />
        Senha: <input type="password" name="senha" /><br />
        <h3>Endereço</h3>
        Rua: <input type="text" name="rua" /><br />
        Número: <input type="text" name="numero" /><br />
        Complemento: <input type="text" name="complemento" /><br />
        Bairro: <input type="text" name="bairro" /><br />
        <input type="submit" name="cadastrar" value="Cadastrar" />
    </form>
</body>

</html>