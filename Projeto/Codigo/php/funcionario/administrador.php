<?php

// Incluir o arquivo de conexão com o banco de dados
include("db_connect.php");

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
$admin= $_SESSION['admin'];

if (!isset($_SESSION['cpf'])) {
header('location: login_funcionario.php');
exit;
}
if (isset($_SESSION['cpf']) && $admin == 'nao' ) {
    header('location: plataforma_funcionario.php');
    exit;
    }

// Capturar o nome do usuário logado
$cpf = $_SESSION['cpf'];

// Buscar o usuário no banco de dados
$query = "SELECT * FROM funcionario WHERE cpf = '$cpf'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);


if(isset($_POST['demitir'])){
    $funcionario = $_POST['funcionario'];
    $sql = "DELETE FROM funcionario WHERE id = '$funcionario'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Funcionario demitido com sucesso!";
    }else{
        echo "Erro ao demitir funcionario!";
    }
}
if(isset ($_POST['promover'])){
    $funcionario = $_POST['funcionario'];
    $sql = "UPDATE funcionario SET administrador = 'sim' WHERE id = '$funcionario'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Funcionario promovido com sucesso!";
    }else{
        echo "Erro ao promover funcionario!";
    }
}

if(isset ($_POST['rebaixar'])){
    $funcionario = $_POST['funcionario'];
    $sql = "UPDATE funcionario SET administrador = 'nao' WHERE id = '$funcionario'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Funcionario promovido com sucesso!";
        if($user['id'] == $funcionario){
            header('location: logout.php');
        }
    }else{
        echo "Erro ao promover funcionario!";
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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h2>Demitir funcionario</h2>
    <?php
   // Seleciona todos os dados da tabela funcionarios
$sql = "SELECT nome, id FROM funcionario WHERE administrador = 'nao'";

// Executa a consulta
$result = mysqli_query($conn, $sql);

// Se houver resultados
if (mysqli_num_rows($result) > 0) {
    // Loop para exibir todos os resultados
    echo '<select name="funcionario" id="funcionario">';
    while ($row = mysqli_fetch_assoc($result)) {
        // Cria o select
        
        // Loop para criar todas as opções
        echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
    }
    // Fecha o select
    echo '</select>';
    echo ' <input type="submit" name="demitir" value="Demitir">';
} else {
    echo 'Nenhum resultado encontrado.';
}   
        
    ?>
    
</form>
<form action="" method="post">
    <h2>Tornar funcionario administrador</h2>
    <?php
   // Seleciona todos os dados da tabela funcionarios
$sql = "SELECT nome, id FROM funcionario WHERE administrador = 'nao'";

// Executa a consulta
$result = mysqli_query($conn, $sql);

// Se houver resultados
if (mysqli_num_rows($result) > 0) {
    // Loop para exibir todos os resultados
    echo '<select name="funcionario" id="funcionario">';
    while ($row = mysqli_fetch_assoc($result)) {
        // Cria o select
        
        // Loop para criar todas as opções
        echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
    }
    // Fecha o select
    echo '</select>';
    echo ' <input type="submit" name="promover" value="Promover">';
} else {
    echo 'Nenhum resultado encontrado.';
}
    
    ?>
    


</form>

<form action="" method="post">
    <h2>Rebaixar funcionario</h2>
    <?php
   // Seleciona todos os dados da tabela funcionarios
$sql = "SELECT nome, id FROM funcionario WHERE administrador = 'sim'";

// Executa a consulta
$result = mysqli_query($conn, $sql);

// Se houver resultados
if (mysqli_num_rows($result) > 1) {
    // Loop para exibir todos os resultados
    echo '<select name="funcionario" id="funcionario">';
    while ($row = mysqli_fetch_assoc($result)) {
        // Cria o select
        
        // Loop para criar todas as opções
        echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
    }
    // Fecha o select
    echo '</select>';
    echo ' <input type="submit" name="rebaixar" value="Rebaixar">';
} else {
    echo 'Nenhum resultado encontrado.';
}   
    
    ?>
    


</form>


    <h2>Lista de funcionarios</h2>
    <?php
   // Seleciona todos os dados da tabela funcionarios
$sql = "SELECT nome, id, cpf, administrador FROM funcionario";

// Executa a consulta
$result = mysqli_query($conn, $sql);

// Se houver resultados
if (mysqli_num_rows($result) > 0) {
    // Loop para exibir todos os resultados
    echo "<table>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Nome</th>";
  echo "<th>CPF</th>";
  echo "<th>Permissão administrativa</th>";
  echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"]. "</td>";
        echo "<td>" . $row["nome"]. "</td>";
        echo "<td>" . $row["cpf"]. "</td>";
        echo "<td>" . $row["administrador"]. "</td>";
        echo "</tr>";
    }
    echo '</table>';
} else {
    echo 'Nenhum resultado encontrado.';
}   
    
    ?>
    


</form>

</body>
</html>