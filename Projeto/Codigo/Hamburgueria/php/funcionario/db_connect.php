
<?php

// Dados da conexão
$host = 'localhost';
$db_name = 'lanchonete';
$username = 'root';
$password = '';

// Criar a conexão
$conn = mysqli_connect($host, $username, $password, $db_name);

// Verificar se a conexão foi realizada com sucesso
if (!$conn) {
die ("Falha na conexão: " . mysqli_connect_error());
}

?>

