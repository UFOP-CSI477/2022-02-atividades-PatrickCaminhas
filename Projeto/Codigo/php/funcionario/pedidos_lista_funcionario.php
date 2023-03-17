<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body class="bg-dark">


<?php

// Incluir o arquivo de conexão com o banco de dados
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



// verifica se a conexão foi estabelecida
if (!$conn) {
  die("A conexão falhou: " . mysqli_connect_error());
}
?>
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
                            <?php echo "CPF: ".$user['cpf']; ?>
                        </h5>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="plataforma_funcionario.php">Plataforma</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pedidos_funcionario.php">Alterar pedidos abertos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active fw-bolder" aria-current="page" href="pedidos_lista_funcionario.php">Pedidos fechados</a>
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


<?php


// cria a query
$sql = "SELECT *, email, nome FROM pedidos INNER JOIN usuario ON usuario.id = pedidos.user_id WHERE status = 'Concluido'";

// executa a query
$resultado = mysqli_query($conn, $sql);

// verifica se houveram resultados
if (mysqli_num_rows($resultado) > 0) {
  echo "<table class='table table-dark table-bordered table-striped'>";
  echo "<tr>";
  echo "<th class='text-danger'>E-mail do usuario</th>";
  echo "<th class='text-danger'>Nome</th>";
  echo "<th class='text-danger'>Pedido</th>";
  echo "<th class='text-danger'>Data da criação</th>";
  echo "<th class='text-danger'>Status</th>";
  echo "<th class='text-danger'>Ultima atualização</th>";
  echo "<th class='text-danger'>Total</th>";
  echo "</tr>";

  // output data of each row
  while($row = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td class='text-danger'>" . $row["email"]. "</td>";
    echo "<td class='text-danger'>" . $row["nome"]. "</td>";
    echo "<td class='text-danger'>" . $row["lanches"]. "</td>";
    echo "<td class='text-danger'>" . $row["criacao_pedido"]. "</td>";

    echo "<td class='text-danger'>" . $row["status"]. "</td>";
    echo "<td class='text-danger'>" . $row["ultima_atualizacao"]. "</td>";
    echo "<td class='text-danger'>" ."R$". $row["preco"].",00". "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "Nenhum resultado encontrado.";
}

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>