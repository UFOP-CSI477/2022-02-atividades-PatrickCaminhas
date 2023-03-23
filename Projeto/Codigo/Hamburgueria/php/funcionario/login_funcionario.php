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
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionario iLanches - Login de funcionario</title>
    <link rel="shortcut icon" href="../../images/ms-icon-310x310.png" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="titulo mx-auto">
        <img src="../../images/titulo.png" alt="iLanches Titulo">
    </div>
    


<?php 
if (isset($errMsg)) {
echo '<div>'.$errMsg.'</div>'; 
}
?>
 
 <div class="col-md-10  mx-auto mt-3 col-lg-4 ">
<form class="p-4 p-md-5 border rounded-3 bg-dark border border-danger" action="" method="post">
<h4 class="text-danger">Login - Funcionários</h4>
  <div class="form-floating mb-3">
<input type="text" name="cpf" class="form-control" placeholder="CPF" required />
<label for="floatingInput">CPF</label>
</div>
<div class="form-floating mb-3">
<input type="password" name="senha" class="form-control" placeholder="Password" required />
<label for="floatingPassword">Senha</label>
</div>
<input type="submit" name="login" class="w-100 btn btn-lg btn-danger" value="Login" />

</form>
<div class="btnindex">
            <div class="row">
            <a href="../../../index.php" class="btn btn-lg btn-danger">VOLTAR</a></div>
        </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>


