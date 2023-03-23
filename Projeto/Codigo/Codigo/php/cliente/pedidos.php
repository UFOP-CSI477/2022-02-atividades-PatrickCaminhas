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




$dbhost = 'localhost'; // endereço do servidor de banco de dados
$dbuser = 'root'; // usuário do banco de dados
$dbpass = ''; // senha do usuário do banco de dados
$dbname = 'lanchonete'; // nome do banco de dados


$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);



$quantity = "SELECT COUNT(*) FROM cardapio";
$result = mysqli_query($con, $quantity);
$linhas = mysqli_fetch_row($result);
$quantity = "SELECT nome FROM cardapio";
$result = mysqli_query($con, $quantity);
$nomes = mysqli_fetch_all($result);
$pedido;
$total_preco;




if (!$con) {
    die('Não foi possível conectar: ' . mysqli_error($con));
}

if (isset($_POST['cadastrar'])) {
    
    foreach($nomes as $nome) {
        ${$nome[0]} = $_POST[$nome[0].'qtd'];
    }
    
   {

    
    for($i = 0; $i < $linhas[0]; $i++){
        if(${$nomes[$i][0]} > 0){
            $lanche = $nomes[$i][0];
            $qtd= ${$nomes[$i][0]};

            $query = "SELECT preco FROM cardapio WHERE nome = '$lanche'";
            
            $result = mysqli_query($con, $query);
            $precos = mysqli_fetch_all($result);
            
            $valor = (int)$precos[0][0]*$qtd;
            $total_preco = $total_preco + $valor;
        }
    }

    
      
        
        
        for($i = 0; $i < $linhas[0]; $i++){
            if(${$nomes[$i][0]} > 0){
                $pedido =$pedido.$nomes[$i][0].": ".${$nomes[$i][0]}." | ";
            }
        }
        echo $pedido;
        if($pedido == ""){
            echo  "<script>alert('Nenhum lanche selecionado!');
            location.href='pedidos.php';</script>";
            
            exit();
            
        }
       
      
        
        $user_id = $user['id'];
        $endereco= $user['rua'].", ".$user['numero']." ".$user['complemento']." - ".$user['bairro'];
        $sql = "INSERT INTO `pedidos`(user_id, lanches, criacao_pedido, ultima_atualizacao, status, preco, endereco) VALUES ('$user_id', '$pedido', NOW(), NOW(),'Pedido recebido', '$total_preco', '$endereco')";
       





        if (mysqli_query($con, $sql)) {
          echo  "<script>alert('Pedido realizado com sucesso!');
          location.href='profile.php';</script>";

           
            
        } else {
          echo  "<script>alert('Erro ao realizar pedido!');
          location.href='pedidos.php';</script>";
        }
    }
   
}
?>


<html>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iLanches - Novo Pedido</title>
    <link rel="shortcut icon" href="../../images/ms-icon-310x310.png" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
            <a class="nav-link active fw-bolder" aria-current="page" href="pedidos.php">Novo pedido</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cancelamento_pedidos.php">Cancelar pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pedidos_lista.php">Pedidos fechados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="alterar_dados.php">Alterar dados cadastrais</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Sair</a>
          </li>
       
        </ul>

      </div>
    </div>
  </div>
</nav></div>
  
    
    <div class="col-md-10  mx-auto mt-3 col-lg-4">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="p-4 p-md-5 border border-danger rounded-3 bg-dark" method="post">
        <h1 class="text-danger">Realização de pedidos</h1>
        <table class=" table border border-dark table-dark table-striped ">
          
      <?php 
      
      foreach($nomes as $nome) {
        
      ?>
            <tr>
                <td><label class="form-label text-danger fw-semibold"> <?php echo $nome[0]."  "; ?> </label></td>
                <td><input type="number" class="form-control"  name="<?php echo $nome[0]; ?>qtd" /></td>
            </tr>
      <?php 
    }
      ?>
        </table>


        <input type="submit" name="cadastrar" class="w-100 btn btn-lg btn-danger" value="Cadastrar" />
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>