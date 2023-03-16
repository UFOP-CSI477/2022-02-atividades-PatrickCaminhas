<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <a href="plataforma_funcionario.php">Voltar</a>

<?php

// Incluir o arquivo de conexão com o banco de dados
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



// verifica se a conexão foi estabelecida
if (!$conn) {
  die("A conexão falhou: " . mysqli_connect_error());
}

// cria a query
$sql = "SELECT *, email, nome FROM pedidos INNER JOIN usuario ON usuario.id = pedidos.user_id WHERE status = 'Concluido'";

// executa a query
$resultado = mysqli_query($conn, $sql);

// verifica se houveram resultados
if (mysqli_num_rows($resultado) > 0) {
  echo "<table>";
  echo "<tr>";
  echo "<th>E-mail do usuario</th>";
  echo "<th>Nome</th>";
  echo "<th>Pedido</th>";
  echo "<th>Data da criação</th>";
  echo "<th>Status</th>";
  echo "<th>Ultima atualização</th>";
  echo "<th>Total</th>";
  echo "</tr>";

  // output data of each row
  while($row = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>" . $row["email"]. "</td>";
    echo "<td>" . $row["nome"]. "</td>";
    echo "<td>" . $row["lanches"]. "</td>";
    echo "<td>" . $row["criacao_pedido"]. "</td>";

    echo "<td>" . $row["status"]. "</td>";
    echo "<td>" . $row["ultima_atualizacao"]. "</td>";
    echo "<td>" ."R$". $row["preco"].",00". "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "Nenhum resultado encontrado.";
}

?>

</body>
</html>