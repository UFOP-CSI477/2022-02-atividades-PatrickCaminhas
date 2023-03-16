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
$username = $_SESSION['cpf'];

// Buscar o usuário no banco de dados
$query = "SELECT * FROM status";
$result = mysqli_query($conn, $query);
$status = mysqli_fetch_assoc($result);
$statusString =$status['estaAberto'];



if(isset($_POST['alterarStatus'])){
    $statusLanchonete = $_POST['status'];
   

    $sql = "UPDATE status SET estaAberto='$statusLanchonete'";
    
    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
        
        echo "O endereço foi alterado com sucesso!";
        header('location: status_lanchonete.php');
    } else {
        echo "Erro ao alterar o endereço!";
        
    }
}


?>
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
    <h1>Alterar status da lanchonete</h1>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="status">A lanchonete está <?php echo $statusString ?> </label>
        <br>
        <select name="status" id="status" placeholder="">

            <option value="aberta">Aberta</option>
            <option value="fechada">Fechada</option>
        </select>
        <input type="submit" name="alterarStatus" value="Alterar">
    </form>
</body>

</html>

