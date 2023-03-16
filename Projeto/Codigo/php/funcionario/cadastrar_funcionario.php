<?php


// Incluir o arquivo de conexão com o banco de dados
include("db_connect.php");

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
header('location: login_funcionario.php');
exit;
}

// Capturar o nome do usuário logado
$cpf = $_SESSION['cpf'];

// Buscar o usuário no banco de dados
$query = "SELECT * FROM funcionario WHERE cpf = '$cpf'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);


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
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM funcionario WHERE cpf = '$cpf'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
        echo  "<script>alert('CPF já cadastrado!');</script>";
    } else {

        $sql = "INSERT INTO funcionario (nome, cpf, senha, administrador) VALUES ('$nome', '$cpf', '$senha', 'nao')";

        if (mysqli_query($con, $sql)) {
            echo  "<script>alert('Funcionario cadastrado com sucesso!');</script>";
            header('location: plataforma_funcionario.php');
        } else {
            echo  "<script>alert('Erro ao cadastrar usuario!');</script>";
            header('location: cadastrar_funcionario.php');
        }
    }
}
?>


<html>

<head>
    <title>Cadastro de funcionario</title>
</head>

<body>
    <a href="plataforma_funcionario.php">Voltar</a>
    <h1>Cadastro de funcionario</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h3>Dados</h3>
        Nome: <input type="text" name="nome" /><br />
        CPF: <input type="number" name="cpf" /><br />
        Senha: <input type="password" name="senha" /><br />
        <input type="submit" name="cadastrar" value="Cadastrar" />
    </form>
</body>

</html>