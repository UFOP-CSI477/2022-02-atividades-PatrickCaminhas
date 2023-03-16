<?php

// Incluir o arquivo de conexão com o banco de dados
include("db_connect.php");

// Verificar se o botão de login foi pressionado
if (isset($_POST['login'])) {

// Capturar os dados do formulário
$cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
$password = mysqli_real_escape_string($conn, $_POST['senha']);
$password =$password = md5($password);
//Verificar se o usuário existe no banco de dados
$query = "SELECT * FROM funcionario WHERE cpf = '$cpf' and senha = '$password'";

$result = mysqli_query($conn, $query);
// Verificar se a consulta retornou algum registro
if (mysqli_num_rows($result) == 1) {
// Iniciar a sessão e guardar o nome de usuário

$query2 = "SELECT administrador FROM funcionario WHERE cpf = '$cpf' and senha = '$password'";
$result2 = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result2);
$admin = $row['administrador'];

session_start();
$_SESSION['cpf'] = $cpf;
$_SESSION['admin'] = $admin;

// Redirecionar o usuário para a página de perfil
header('location: plataforma_funcionario.php');

} else {
// Exibir uma mensagem de erro se a senha estiver incorreta


echo  "<script>alert('CPF ou senha incorretos!');</script>";

}
}

?>

<html>
<head>
<title>Login Funcionario</title>
</head>
<body>

<?php 
if (isset($errMsg)) {
echo '<div>'.$errMsg.'</div>'; 
}
?>
    <ul>
        <li><a href="../../index.php">Inicio</a></li>
        <li><a href="cardapio.php">Cardapio</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="cadastro.php">Cadastro</a></li>
        </ul>
<div>
<form action="" method="post">
<input type="text" name="cpf" placeholder="CPF" required />
<input type="password" name="senha" placeholder="Senha" required />
<input type="submit" name="login" value="Login" />
</form>
</div>

</body>
</html>


