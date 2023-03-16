<?php
include("db_connect.php");
$dbhost = 'localhost'; // endereço do servidor de banco de dados
$dbuser = 'root'; // usuário do banco de dados
$dbpass = ''; // senha do usuário do banco de dados
$dbname = 'lanchonete'; // nome do banco de dados

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$quantity = "SELECT COUNT(*) FROM cardapio";
$result = mysqli_query($con, $quantity);
$linhas = mysqli_fetch_row($result);


$quantity = "SELECT preco FROM cardapio where nome = 'X-Tudo'";
$result = mysqli_query($con, $quantity);
$nomes = mysqli_fetch_all($result);
$linhas = mysqli_fetch_row($result);
$valor= $linhas[0];
echo $nomes[0][0]*3;
foreach($nomes as $nome) {
    //echo $nome[0];
}


foreach($nomes as $nome) {
    ${$nome[0]} = $_POST[$nome[0].'qtd'];
}
?>