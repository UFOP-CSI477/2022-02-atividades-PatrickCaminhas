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

?>
<html>
<head>
<title>Perfil</title>
</head>
<body>

<h1>Perfil</h1>

<div>
<p>Bem vindo(a),<?php echo $user['nome']; ?></p>
</div>  
<h3>Pedidos abertos</h3>
<a href="pedidos_funcionario.php">Alterar status</a>
<br>
<h3>Pedidos fechados</h3>
<a href="pedidos_lista_funcionario.php">Verificar</a>
<br>
<h3>Lanchonete</h3>
<a href="status_lanchonete.php">Alterar status</a>
<?php
if ($user['administrador'] == 'sim') {
 echo "<h3>Administrativo</h3><a href='administrador.php'>Funções do administrador</a>";
 echo "<br><a href='cadastrar_funcionario.php'>Cadastrar funcionário</a>";
}
?>

<br>
<br>
<a href="logout.php">Sair</a>

</body>
</html>