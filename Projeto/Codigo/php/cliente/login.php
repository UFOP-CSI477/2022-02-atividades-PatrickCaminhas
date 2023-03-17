<?php

// Incluir o arquivo de conexão com o banco de dados
include("db_connect.php");

// Verificar se o botão de login foi pressionado
session_start();


if (isset($_SESSION['username'])) { 
    header('location: profile.php');
    exit;
}
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="titulo mx-auto">
        <img src="../../images/titulo.png" alt="iLanches Titulo" >
    </div>
    <div><nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h4 class="offcanvas-title" id="offcanvasDarkNavbarLabel">iLanches</h4>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link"  href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cardapio.php">Cardapio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro.php">Cadastro</a>
          </li>
       
        </ul>

      </div>
    </div>
  </div>
</nav></div>




<?php 
if (isset($errMsg)) {
echo '<div>'.$errMsg.'</div>'; 
}
?>

<div class="col-md-10  mx-auto mt-3 col-lg-4 ">
<form class="p-4 p-md-5 border rounded-3 bg-dark border border-danger" action="" method="post">
  <h4 class="text-danger">Login</h4>
  <div class="form-floating mb-3">
<input type="text" name="username" class="form-control" placeholder="Username" required />
<label for="floatingInput">Endereço de e-mail</label>
</div>
<div class="form-floating mb-3">
<input type="password" name="senha" class="form-control" placeholder="Password" required />
<label for="floatingPassword">Senha</label>
</div>
<input type="submit" name="login" class="w-100 btn btn-lg btn-danger" value="Login" />

</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>


