<?php

// Incluir o arquivo de conexão com o banco de dados
include("db_connect.php");

// Verificar se o botão de login foi pressionado
if (isset($_POST['login'])) {

// Capturar os dados do formulário
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['senha']);
$password =$password = md5($password);
//Verificar se o usuário existe no banco de dados
$query = "SELECT * FROM usuario WHERE email = '$username' and senha = '$password'";

$result = mysqli_query($conn, $query);
// Verificar se a consulta retornou algum registro
if (mysqli_num_rows($result) == 1) {
// Iniciar a sessão e guardar o nome de usuário
session_start();
$_SESSION['username'] = $username;

// Redirecionar o usuário para a página de perfil
header('location: profile.php');

} else {
// Exibir uma mensagem de erro se a senha estiver incorreta


echo  "<script>alert('Email ou senha incorretos!');</script>";

}
}

?>

<html>
<head>
<title>Login</title>
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
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="senha" placeholder="Password" required />
<input type="submit" name="login" value="Login" />
</form>
</div>

</body>
</html>


