<?php

include("db_connect.php");

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit;
}

// Capturar o nome do usuário logado
$username = $_SESSION['username'];

// Buscar o usuário no banco de dados
$query = "SELECT * FROM usuario WHERE email = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>
</html>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iLanches - Cancelamento</title>
    <link rel="shortcut icon" href="../../images/ms-icon-310x310.png" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="bg-dark">


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
            <a class="nav-link active fw-bolder" aria-current="page" href="alterar_dados.php">Cancelar pedidos</a>
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

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <center><h4 class="text-danger fw-bold">Cancelamento de pedidos</h4></center>
    <center> <h5 class="text-danger">Só podem ser cancelados pedidos aceitos, aqueles que estão em estado de preparo ou foram enviados não podem ser cancelados! </h5></center>


    
    
    <?php

  

  



    // verifica se a conexão foi estabelecida
    if (!$conn) {
        die("A conexão falhou: " . mysqli_connect_error());
    }

    // cria a query
    $sql = "SELECT * FROM pedidos INNER JOIN usuario ON usuario.id = pedidos.user_id WHERE user_id = '$user[id]' AND NOT status = 'Concluido' AND NOT status = 'Cancelado' and NOT status = 'Em preparo' AND NOT status = 'Enviado'";
    
    $sql2 = "SELECT pedidoID FROM pedidos WHERE user_id = '$user[id]' AND NOT status = 'Concluido' AND NOT status = 'Cancelado'";
    $resultado2 = mysqli_query($conn, $sql2);
    $pedidos = mysqli_fetch_all($resultado2);
    // executa a query
    $resultado = mysqli_query($conn, $sql);
    foreach($pedidos as $pedido){
        $pedidoId = $pedido[0];
      
        
        
    }
  

    // verifica se houveram resultados
    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table table-dark table-bordered table-striped'>";
        echo "<tr>";
        echo "<th class='text-danger'>Pedido</th>";
        echo "<th class='text-danger'>Data da criação</th>";
        echo "<th class='text-danger'>Status</th>";
        echo "<th class='text-danger'>Ultima atualização</th>";
        echo "<th class='text-danger'>Total</th>";
        echo "<th class='text-danger'>Alterar</th>";
        echo "</tr>";

        // output data of each row
        $i=0;
        while ($row = mysqli_fetch_assoc($resultado)) {
            
            ?>
            <tr>
  
            <td class="text-danger"><?php echo $row["lanches"] ;?> </td>
            <td class="text-danger"><?php echo $row["criacao_pedido"]; ?> </td>
            <td class="text-danger"><?php echo $row["status"]; ?> </td>
            <td class="text-danger"><?php echo $row["ultima_atualizacao"]; ?> </td>
            <td class="text-danger"><?php echo "R$" . $row["preco"] . ",00" ?> </td>
            <td>      <select name="<?php echo $pedidos[$i][0]; ?>status" id="<?php echo $pedidos[$i][0]; ?>status"  placeholder="" class="form-select text-danger bg-dark border-danger fw-semibold">
                                <option value='<?php echo $row["status"]; ?>' selected><?php echo $row["status"]; ?></option>
                                <option value='Cancelado'>Cancelado</option>
                            </select> 

                </td> 
            </tr>
            <?php
      
            $i++;
        }
        echo "</table>";
    } else {
        echo "<h3<Nenhum resultado encontrado.<h3>";
    }
    $querryQtd = "SELECT COUNT(*) AS qtd FROM pedidos WHERE NOT status = 'Concluido'";
    $resultQtd = mysqli_query($conn, $querryQtd);
    $qtd = mysqli_fetch_assoc($resultQtd);
    
    for($i=0; $i<$qtd['qtd']; $i++){
      
        if(isset($_POST['alterarStatus'])){
            $stringNome =$pedidos[$i][0].'status';
            $varivalStatus= $_POST[$stringNome];
       
            $id = $pedidos[$i][0];
            $sql = "UPDATE pedidos SET status = '$varivalStatus', ultima_atualizacao = NOW() WHERE pedidoId = '$id'";
            $result = mysqli_query($conn, $sql);
            if($result){
               // echo "Status alterado com sucesso";
               echo "<script> window.location.replace('cancelamento_pedidos.php'); </script>";
              
            }else{
                echo "Erro ao alterar status";
            }
        }
    }
    if(mysqli_num_rows($resultado) > 0){
    ?>
  
       <input type="submit" name="alterarStatus"  class="mt-2 btn btn-lg btn-danger" value="Alterar">
    <?php
    }
    else{
        echo "<center><h4 class='text-danger' > Não há pedidos para serem cancelados </h4></center>";
    }
    ?>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>
