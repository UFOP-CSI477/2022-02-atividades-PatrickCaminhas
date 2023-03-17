<?php

include("db_connect.php");

// Verificar se o botão de login foi pressionado
session_start();


if (isset($_SESSION['username'])) { 
    header('location: profile.php');
    exit;
}


if (isset($_SESSION['username'])) { 
    header('location: profile.php');
    exit;
}


if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha = md5($senha);
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];

    $query = "SELECT * FROM usuario WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        echo  "<script>alert('Email já cadastrado!');</script>";
    } else {

        $sql = "INSERT INTO usuario (nome, email, senha,rua,numero,complemento,bairro)
    VALUES ('$nome', '$email', '$senha','$rua','$numero','$complemento','$bairro')";

        if (mysqli_query($conn, $sql)) {
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
            <a class="nav-link " href="cardapio.php">Cardapio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page"href="cadastro.php">Cadastro</a>
          </li>
       
        </ul>

      </div>
    </div>
  </div>
</nav></div>
<div class="col-md-10  mx-auto mt-3 col-lg-4 ">
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="p-4 p-md-5 border rounded-3 bg-dark border border-danger">
    <h3 class="text-danger">Cadastro de usuário</h1>
        <h4 class="text-danger">Dados Pessoais</h4>
        <div class="form-floating mb-3">
        <input type="text" name="nome" class="form-control" placeholder="Nome" required />
        <label for="floatingInput">Nome</label>
        </div>
        <div class="form-floating mb-3">
        <input type="text" name="email" class="form-control" placeholder="E-mail" required />
        <label for="floatingInput">Endereço de e-mail</label>
        </div>
        <div class="form-floating mb-3">
        <input type="password" name="senha" class="form-control" placeholder="Password" required />
        <label for="floatingPassword">Senha</label>
        </div>

        <h4 class="text-danger">Endereço</h3>
        <div class="form-floating mb-3">
        <input type="text" name="rua" class="form-control" placeholder="Rua" required />
        <label for="floatingInput">Rua</label>
        </div>
        <div class="form-floating mb-3">
        <input type="number" name="numero" class="form-control" placeholder="Numero" required />
        <label for="floatingInput">Número</label>
        </div>
        <div class="form-floating mb-3">
        <input type="text" name="complemento" class="form-control" placeholder="Complemento" />
        <label for="floatingInput">Complemento</label>
        </div>
        <div class="form-floating mb-3">
        <input type="text" name="bairro" class="form-control" placeholder="Bairro" required />
        <label for="floatingInput">Bairro</label>
        </div>
        <div >
        <input type="submit" name="cadastrar" value="Cadastrar" class="mx-auto btn btn-lg btn-danger"/>
        </div>
    </form>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>