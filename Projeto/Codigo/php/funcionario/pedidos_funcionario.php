<?php

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
?>
</html>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="bg-dark">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <div class="titulo mx-auto">
        <img src="../../css/titulo.png" alt="iLanches Titulo" >
    </div>
    <div>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h4 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                            <?php echo "Nome: ".$user['nome']; ?>
                            <br>
                            <?php echo "CPF: ". $user['cpf']; ?>
                        </h4>


                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                            
                        </h5>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" href="plataforma_funcionario.php">Plataforma</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active fw-bolder" aria-current="page" href="pedidos_funcionario.php">Alterar pedidos abertos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pedidos_lista_funcionario.php">Pedidos fechados</a>
                            </li>

                            <?php
                            if ($user['administrador'] == 'sim') {
                                echo "<li class='nav-item'> <a class='nav-link' href='administrador.php'>Funções do administrador</a></li>";
                                echo "<li class='nav-item'> <a class='nav-link' href='cadastrar_funcionario.php'>Cadastrar funcionário</a></li>";
                            }
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Sair</a>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
        </nav>
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php

  

  



    // verifica se a conexão foi estabelecida
    if (!$conn) {
        die("A conexão falhou: " . mysqli_connect_error());
    }

    // cria a query
    $sql = "SELECT * FROM pedidos INNER JOIN usuario ON usuario.id = pedidos.user_id WHERE NOT status = 'Concluido'";
    
    $sql2 = "SELECT pedidoID FROM pedidos WHERE NOT status = 'Concluido'";
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
        echo "<th class='text-danger'>ID</th>";
        echo "<th class='text-danger'>E-mail do usuario</th>";
        echo "<th class='text-danger'>Pedido</th>";
        echo "<th class='text-danger'>Data da criação</th>";
        echo "<th class='text-danger'>Status</th>";
        echo "<th class='text-danger'>Ultima atualização</th>";
        echo "<th class='text-danger'>Total</th>";
        echo "<th class='text-danger'>Concluir</th>";
        echo "</tr>";

        // output data of each row
        $i=0;
        while ($row = mysqli_fetch_assoc($resultado)) {
            
            ?>
            <tr>
            <td class="text-danger"><?php echo $row["pedidoId"]; ?> </td>
            <td class="text-danger"><?php echo $row["email"]; ?> </td>
            <td class="text-danger"><?php echo $row["lanches"] ;?> </td>
            <td class="text-danger"><?php echo $row["criacao_pedido"]; ?> </td>
            <td class="text-danger"><?php echo $row["status"]; ?> </td>
            <td class="text-danger"><?php echo $row["ultima_atualizacao"]; ?> </td>
            <td class="text-danger"><?php echo "R$" . $row["preco"] . ",00" ?> </td>
            <td>      <select name="<?php echo $pedidos[$i][0]; ?>status" id="<?php echo $pedidos[$i][0]; ?>status"  placeholder="" class="form-select text-danger bg-dark border-danger fw-semibold">
                                <option value='<?php echo $row["status"]; ?>' selected hidden><?php echo $row["status"]; ?></option>
                                <option value='Aceito'>Aceito</option>
                                <option value='Em preparo'>Em preparo</option>
                                <option value='Enviado'>Enviado</option>
                                <option value='Concluido'>Concluido</option>
                            </select> 

                </td> 
            </tr>
            <?php
      
            $i++;
        }
        echo "</table>";
    } else {
        echo "Nenhum resultado encontrado.";
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
               echo "<script> window.location.replace('pedidos_funcionario.php'); </script>";
              
            }else{
                echo "Erro ao alterar status";
            }
        }
    }
    
    ?>
  
       <input type="submit" name="alterarStatus"  class="mt-2 btn btn-lg btn-danger" value="Alterar">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>