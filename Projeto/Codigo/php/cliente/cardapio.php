<?php
            include("db_connect.php");

            // Iniciar a sessão
session_start();


            ?>

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
                        <?php
                       
                        if (isset($_SESSION['username'])) { 
                            $username = $_SESSION['username'];
                            $query = "SELECT * FROM usuario WHERE email = '$username'";
                            $result = mysqli_query($conn, $query);
                            $user = mysqli_fetch_assoc($result);

                            echo "Nome: ".$user['nome'];
                            echo "<br>Email: ".$user['email'];
                        }
                        if(!isset($_SESSION['username'])){
                            echo "iLanches";
                        }
                        ?>
                        </h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <?php
                            if (!isset($_SESSION['username'])) {
                               
                                
                            echo "<li class='nav-item'>
                                <a class='nav-link'  href='index.php'>Home</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link active fw-bolder' aria-current='page' href='cardapio.php'>Cardapio</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='login.php'>Login</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='cadastro.php'>Cadastro</a>
                            </li>";
                        }
                           
                            if (isset($_SESSION['username'])) {
                               
                                
                            echo "<li class='nav-item'>
                                <a class='nav-link' href='profile.php'>Plataforma</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link active fw-bolder' aria-current='page' href='cardapio.php'>Cardapio</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='pedidos.php'>Novo pedido</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='alter_dados.php'>Alterar Dados cadastrais</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='logout.php'>Logout</a>
                            </li>";
                        }
                            ?>

                        </ul>

                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div>
        <div>
            <?php
            




            $simples = "SELECT * FROM cardapio WHERE tipo = 'Simples' ORDER BY preco ASC";
            $resultS = mysqli_query($conn, $simples);
          

            $artesanal = "SELECT * FROM cardapio WHERE tipo = 'Artesanal' ORDER BY preco ASC";
            $resultA = mysqli_query($conn, $artesanal);
          

            ?>
            <div class="col-md-10  mx-auto mt-3 col-lg-8">
                <div class="p-4 p-md-5 border border-danger rounded-3 bg-dark">
                    <h3 class="text-danger"> CARDAPIO</h4>
                    <h4 class="text-danger"> Lanches simples</h4>
                    
                    <img src="../../images/simples.png" style="width:20vh;" alt="">
                    <p class="text-danger">Lanches com bife de hamburguer bovino.</p>
                <table class='table table-dark table-bordered table-striped'>
                    <tr>
                    <th class="text-danger">Nome</th>
                        <th class="text-danger">Ingredientes</th>
                        <th class="text-danger">Preço</th>

                    </tr>
                    <?php
                    while ($r_simples = mysqli_fetch_array($resultS)) {
                       
                        echo "<tr>";
                        echo "<td class='text-danger'>" . $r_simples['nome'] . "</td>";
                        echo "<td class='text-danger'>" . $r_simples['ingredientes'] . "</td>";
                        echo "<td class='text-danger'>R$" . $r_simples['preco'] . ",00</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <h4 class="text-danger"> Lanches artesanais</h4>
                <img class="img-fluid" src="../../images/artesanal.png" style="width:20vh;"alt="">
                <p class="text-danger">Lanches com bife de carne selecionada e ingredientes exclusivos.</p>
                <table class='table table-dark table-bordered table-striped'>
                    <tr>
                        <th class="text-danger">Nome</th>
                        <th class="text-danger">Ingredientes</th>
                        <th class="text-danger">Preço</th>

                    </tr>
                    <?php
                    while ($r_artesanal = mysqli_fetch_array($resultA)) {
                        echo "<tr>";
                        echo "<td class='text-danger'>" . $r_artesanal['nome'] . "</td>";
                        echo "<td class='text-danger'>" . $r_artesanal['ingredientes'] . "</td>";
                        echo "<td class='text-danger'>R$" . $r_artesanal['preco'] . ",00</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                </div>
            </div>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

</body>

</html>