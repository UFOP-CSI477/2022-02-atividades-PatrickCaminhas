<?php


// Incluir o arquivo de conexão com o banco de dados
include("db_connect.php");

// Iniciar a sessão
session_start();

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


$dbhost = 'localhost'; // endereço do servidor de banco de dados
$dbuser = 'root'; // usuário do banco de dados
$dbpass = ''; // senha do usuário do banco de dados
$dbname = 'lanchonete'; // nome do banco de dados

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$con) {
    die('Não foi possível conectar: ' . mysqli_error($con));
}

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $senha = md5($senha);

    $query = "SELECT * FROM funcionario WHERE cpf = '$cpf'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
        echo  "<script>alert('CPF já cadastrado!');</script>";
    } else {

        $sql = "INSERT INTO funcionario (nome, cpf, senha, administrador) VALUES ('$nome', '$cpf', '$senha', 'nao')";

        if (mysqli_query($con, $sql)) {
            echo  "<script>alert('Funcionario cadastrado com sucesso!');</script>";
            header('location: plataforma_funcionario.php');
        } else {
            echo  "<script>alert('Erro ao cadastrar usuario!');</script>";
            header('location: cadastrar_funcionario.php');
        }
    }
}
?>


<html>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionario iLanches - Cadastro de Funcionario</title>
    <link rel="shortcut icon" href="../../images/ms-icon-310x310.png" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <div class="titulo mx-auto">
        <img src="../../images/titulo.png" alt="iLanches Titulo" >
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
                                echo "<li class='nav-item'> <a class='nav-link' href='administrador.php'>Funções do administrador</a></li>";
                                echo "<li class='nav-item'> <a class='nav-link  active fw-bolder' aria-current='page'  href='cadastrar_funcionario.php'>Cadastrar funcionário</a></li>";
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
   
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="p-4 p-md-5 border rounded-3 bg-dark border border-danger" > 
    <h3 class="text-danger">Cadastro de funcionario</h3>
    <h4 class="text-danger">Dados</h4>
        <div class="form-floating mb-3">
        <input type="text" name="nome" class="form-control" placeholder="Nome" required />
        <label for="floatingInput">Nome</label>
        </div>
        <div class="form-floating mb-3">
        <input type="number" name="cpf" class="form-control" placeholder="CPF" required />
        <label for="floatingInput">CPF</label>
        </div>
        <div class="form-floating mb-3">
        <input type="password" name="senha" class="form-control" placeholder="Password" required />
        <label for="floatingPassword">Senha</label>
        </div>
        <div >
        <input type="submit" name="cadastrar" value="Cadastrar" class="mx-auto btn btn-lg btn-danger"/>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>