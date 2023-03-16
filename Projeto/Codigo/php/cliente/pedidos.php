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






if (!$con) {
    die('Não foi possível conectar: ' . mysqli_error($con));
}

if (isset($_POST['cadastrar'])) {
    
    foreach($nomes as $nome) {
        ${$nome[0]} = $_POST[$nome[0].'qtd'];
    }
    
   {

    $total_preco;
    for($i = 0; $i < $linhas[0]; $i++){
        if(${$nomes[$i][0]} > 0){
            $lanche = $nomes[$i][0];
            $qtd= ${$nomes[$i][0]};

            $query = "SELECT preco FROM cardapio WHERE nome = '$lanche'";
            echo $query;
            $result = mysqli_query($con, $query);
            $precos = mysqli_fetch_all($result);
            echo $precos[0][0];
            $valor = (int)$precos[0][0]*$qtd;
            $total_preco = $total_preco + $valor;
        }
    }

    
        echo $total_preco;
        $pedido;
        for($i = 0; $i < $linhas[0]; $i++){
            if(${$nomes[$i][0]} > 0){
                $pedido =$pedido.$nomes[$i][0].": ".${$nomes[$i][0]}." | ";
            }
        }

      
        
        $user_id = $user['id'];
        $sql = "INSERT INTO `pedidos`(user_id, lanches, criacao_pedido, ultima_atualizacao, status, preco) VALUES ('$user_id', '$pedido', NOW(), NOW(),'Pedido recebido', '$total_preco')";
       





        if (mysqli_query($con, $sql)) {
            echo "Pedido realizado com sucesso!";
            header('location: pedidos.php');
            
        } else {
            echo  "<script>alert('Erro ao realizar pedido!');</script>";
            header('location: pedidos.php');
        }
    }
   
}
?>


<html>

<head>
    <title>Realizar Pedidos</title>
</head>

<body>
    <a href="profile.php">Voltar</a>
    <h1>Realização de pedidos</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        
        <table>
      <?php 
      
      foreach($nomes as $nome) {
        
      ?>
            <tr>
                <td><?php echo $nome[0]; ?></td>
                <td><input type="number" name="<?php echo $nome[0]; ?>qtd" /></td>
            </tr>
      <?php 
    }
      ?>
        </table>


        <input type="submit" name="cadastrar" value="Cadastrar" />
    </form>
</body>

</html>