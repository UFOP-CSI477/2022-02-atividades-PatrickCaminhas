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

?>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iLanches - Plataforma</title>
    <link rel="shortcut icon" href="../../images/ms-icon-310x310.png" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="titulo mx-auto">
        <img src="../../images/titulo.png" alt="iLanches Titulo">
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
            <a class="nav-link active fw-bolder" aria-current="page"  href="profile.php">Plataforma</a>
            
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
<div class="col-md-10  mx-auto mt-3 col-lg-8">
 <div  class="p-4 p-md-5 border border-danger rounded-3 bg-dark">  
<h1 class="text-danger">Plataforma</h1>

<div>
<p class="text-danger">Bem vindo(a), <?php echo $user['nome']; ?></p>
</div>
<h3 class="text-danger">Seus pedidos em aberto:</h3>
<?php  
// cria a query
$sql = "SELECT *, email, nome FROM pedidos INNER JOIN usuario ON usuario.id = pedidos.user_id WHERE user_id = '$user[id]' AND NOT status = 'Concluido' AND NOT status = 'Cancelado'";

// executa a query
$resultado = mysqli_query($conn, $sql);

// verifica se houveram resultados
if (mysqli_num_rows($resultado) > 0) {
  echo "<table class='table table-dark table-bordered table-striped'>";
  echo "<tr>";
  echo "<th class='text-danger'>Data e Hora do Pedido</th>";
  echo "<th class='text-danger'>Pedido</th>"; 
  echo "<th class='text-danger'>Status</th>";  
  echo "<th class='text-danger'>Total</th>";
  echo "<th class='text-danger'>Ultima atualização</th>";
 

  echo "</tr>";

  // output data of each row
  while($row = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td class='text-danger'>" . $row["criacao_pedido"]. "</td>";
    echo "<td class='text-danger'>" . $row["lanches"]. "</td>";   
    echo "<td class='text-danger'>" . $row["status"]. "</td>";   
    echo "<td class='text-danger'>" ."R$". $row["preco"].",00". "</td>";
    echo "<td class='text-danger'>" . $row["ultima_atualizacao"]. "</td>";

    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "<center><h4 class='text-danger' > Não há pedidos abertos </h4></center>";
}

?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>
