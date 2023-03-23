<?php

// Incluir o arquivo de conexão com o banco de dados
include("db_connect.php");

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('location: index.php');
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
        
        echo  "<script>alert('Endereço atualizado com sucesso!');</script>";
        
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
    <title>iLanches - Alterar dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="shortcut icon" href="../../images/ms-icon-310x310.png" type="image/x-icon" />

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
      <h4 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><?php echo "Nome: ". $user['nome']; ?>
        <br>
        <?php echo "Email: ".$user['email']; ?>
      </h4>
        
        
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link"  href="profile.php">Plataforma</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cardapio.php">Cardapio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pedidos.php">Novo pedido</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cancelamento_pedidos.php">Cancelar pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pedidos_lista.php">Pedidos fechados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fw-bolder" aria-current="page" href="alterar_dados.php">Alterar dados cadastrais</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Sair</a>
          </li>
       
        </ul>

      </div>
    </div>
  </div>
</nav></div>
<div class="col-md-10  mx-auto mt-3 col-lg-8">
 <div  class="p-4 p-md-5 border border-danger rounded-3 bg-dark">  
    <h1 class="text-danger">Alterar dados cadastrais</h1>
    <h4 class="text-danger">Dados Pessoais</h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="nome"class="form-label text-danger">Nome</label >
        <input type="text" name="nome" id="nome" value="<?php echo $user['nome']; ?>" class="form-control">
        <label for="email" class="form-label text-danger">E-mail</label >
        <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" class="form-control">
        <input type="submit" name="alterarDadosPessoais" value="Alterar" class="mt-2 btn btn-lg btn-danger">
    </form>
    <h4 class="text-danger">Senha</h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="">
        <label for="senha" class="form-label text-danger">Senha</label >
        <input type="password" name="senha" id="senha" class="form-control">
        <label for="senha2" class="form-label text-danger">Confirmar senha</label>
        <input type="password" name="senha2" id="senha2" class="form-control">
        <input type="submit" name="alterarSenha" value="Alterar" class="mt-2 btn btn-lg btn-danger">
    </form>
    <h4 class="text-danger">Endereço </h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="rua" class="form-label text-danger" >Rua</label>
        <input type="text" name="rua" id="rua" class="form-control" value="<?php echo $user['rua']; ?>">
        <label for="numero" class="form-label text-danger">Número</label>
        <input type="text" name="numero" id="numero" class="form-control" value="<?php echo $user['numero']; ?>">
        <label for="complemento" class="form-label text-danger">Complemento</label>
        <input type="text" name="complemento" id="complemento" class="form-control" value="<?php echo $user['complemento']; ?>">
        <label for="bairro" class="form-label text-danger">Bairro</label>
        <input type="text" name="bairro" id="bairro" class="form-control" value="<?php echo $user['bairro']; ?>">
        <input type="submit" name="alterarEndereco" value="Alterar" class="mt-2 btn btn-lg btn-danger">
    </form>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>

