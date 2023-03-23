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
    <title>Funcionario iLanches - Administrador</title>
    <link rel="shortcut icon" href="../../images/ms-icon-310x310.png" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <div  class="titulo mx-auto">
        <img src="../../images/titulo.png" alt="iLanches Titulo">
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
                            <?php echo "Nome: ". $user['nome']; ?>
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
                                <a class="nav-link"
                                    href="plataforma_funcionario.php">Plataforma</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pedidos_funcionario.php">Alterar pedidos abertos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pedidos_lista_funcionario.php">Pedidos fechados</a>
                            </li>

                            <?php
                            if ($user['administrador'] == 'sim') {
                                echo "<li class='nav-item'> <a class='nav-link  active fw-bolder' aria-current='page'  href='administrador.php'>Funções do administrador</a></li>";
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
    <div class="col-md-10  mx-auto mt-3 col-lg-4 ">
<form class="p-4 p-md-5 border rounded-3 bg-dark border border-danger" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h4 class="text-danger">Demitir funcionario</h4>
    <?php
   // Seleciona todos os dados da tabela funcionarios
$sql = "SELECT nome, id FROM funcionario WHERE administrador = 'nao'";

// Executa a consulta
$result = mysqli_query($conn, $sql);

// Se houver resultados
if (mysqli_num_rows($result) > 0) {
    // Loop para exibir todos os resultados
    echo '<select name="funcionario" id="funcionario" class="form-select text-danger bg-dark border-danger fw-semibold">';
    while ($row = mysqli_fetch_assoc($result)) {
        // Cria o select
        
        // Loop para criar todas as opções
        echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
    }
    // Fecha o select
    echo '</select>';
    echo ' <input type="submit" name="demitir" value="Demitir" class="mt-2 btn btn-lg btn-danger">';
} else {
    echo "<center><h5 class='text-danger' > Não há funcionario que possa ser demitido! </h5></center>";
}   
        
    ?>
    
</form>
<div class="col-md-10  mx-auto mt-3 col-lg-4 ">
    </div>
<form class="p-4 p-md-5 border rounded-3 bg-dark border border-danger" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h4 class="text-danger">Tornar funcionario administrador</h4>
    <?php
   // Seleciona todos os dados da tabela funcionarios
$sql = "SELECT nome, id FROM funcionario WHERE administrador = 'nao'";

// Executa a consulta
$result = mysqli_query($conn, $sql);

// Se houver resultados
if (mysqli_num_rows($result) > 0) {
    // Loop para exibir todos os resultados
    echo '<select name="funcionario" id="funcionario" class="form-select text-danger bg-dark border-danger fw-semibold">';
    while ($row = mysqli_fetch_assoc($result)) {
        // Cria o select
        
        // Loop para criar todas as opções
        echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
    }
    // Fecha o select
    echo '</select>';
    echo ' <input type="submit" name="promover" value="Promover" class="mt-2 btn btn-lg btn-danger">';
} else {
    echo "<center><h5 class='text-danger' > Não há funcionario que possa ser administrador! </h5></center>";
}
    
    ?>
    


</form>
</div>
<div class="col-md-10  mx-auto mt-3 col-lg-4 ">
<form class="p-4 p-md-5 border rounded-3 bg-dark border border-danger" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <h4 class="text-danger">Rebaixar funcionario</h4>
    <?php
   // Seleciona todos os dados da tabela funcionarios
$sql = "SELECT nome, id FROM funcionario WHERE administrador = 'sim'";

// Executa a consulta
$result = mysqli_query($conn, $sql);

// Se houver resultados
if (mysqli_num_rows($result) > 1) {
    // Loop para exibir todos os resultados
    echo '<select name="funcionario" id="funcionario" class="form-select text-danger bg-dark border-danger fw-semibold">';
    while ($row = mysqli_fetch_assoc($result)) {
        // Cria o select
        
        // Loop para criar todas as opções
        echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
    }
    // Fecha o select
    echo '</select>';
    echo ' <input type="submit" name="rebaixar" value="Rebaixar" class="mt-2 btn btn-lg btn-danger">';
} else {
    echo "<center><h5 class='text-danger' > Somente você é administrador! </h5></center>";
}   
    
    ?>
    


</form>
    </div>
<div class="col-md-10  mx-auto mt-3 col-lg-4 ">
    <div class="p-4 p-md-5 border rounded-3 bg-dark border border-danger">
    <h4 class="text-danger">Lista de funcionarios</h4>
    <?php
   // Seleciona todos os dados da tabela funcionarios
$sql = "SELECT nome, id, cpf, administrador FROM funcionario";

// Executa a consulta
$result = mysqli_query($conn, $sql);

// Se houver resultados
if (mysqli_num_rows($result) > 0) {
    // Loop para exibir todos os resultados
    echo "<table class='table table-dark table-bordered table-striped'>";
  echo "<tr>";
  echo "<th class='text-danger'>ID</th>";
  echo "<th class='text-danger'>Nome</th>";
  echo "<th class='text-danger'>CPF</th>";
  echo "<th class='text-danger'>Permissão administrativa</th>";
  echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class='text-danger'>" . $row["id"]. "</td>";
        echo "<td class='text-danger'>" . $row["nome"]. "</td>";
        echo "<td class='text-danger'>" . $row["cpf"]. "</td>";
        echo "<td class='text-danger'>" . $row["administrador"]. "</td>";
        echo "</tr>";
    }
    echo '</table>';
} else {
    echo "<center><h5 class='text-danger' > Não foi encontrado funcionario </h5></center>";;
}   
    
    ?>
    </div>
    </div>


</div>
<?php
    // Buscar o usuário no banco de dados
    /*
    $query = "SELECT * FROM status";
    $result = mysqli_query($conn, $query);
    $status = mysqli_fetch_assoc($result);
    $statusString = $status['estaAberto'];



    if (isset($_POST['alterarStatus'])) {
        $statusLanchonete = $_POST['status'];


        $sql = "UPDATE status SET estaAberto='$statusLanchonete'";

        $resultado = mysqli_query($conn, $sql);
        if ($resultado) {

            echo "O endereço foi alterado com sucesso!";
            echo "<script> window.location.replace('administrador.php'); </script>";

        } else {
            echo "Erro ao alterar o endereço!";

        }
    }*/
    ?>
      <!--
    <div class="col-md-10  mx-auto mt-3 col-lg-4 ">
<form class="p-4 p-md-5 border rounded-3 bg-dark border border-danger" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="status" class="text-danger">A lanchonete está <?php echo $statusString ?> </label>
        <br>
        <select name="status" id="status" placeholder="" class="form-select text-danger bg-dark border-danger fw-semibold">
        <option value='<?php echo $statusString; ?>' selected hidden><?php echo $statusString; ?></option>

            <option value="aberta">Aberta</option>
            <option value="fechada">Fechada</option>
        </select>
        <input type="submit" name="alterarStatus" value="Alterar" class="mt-2 btn btn-lg btn-danger">
    </form>

-->




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>