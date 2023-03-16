</html>


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
    $sql = "SELECT * FROM pedidos INNER JOIN usuario ON usuario.id = pedidos.user_id WHERE NOT status = 'Concluido'";
    
    $sql2 = "SELECT pedidoID FROM pedidos WHERE NOT status = 'Concluido'";
    $resultado2 = mysqli_query($conn, $sql2);
    $pedidos = mysqli_fetch_all($resultado2);
    // executa a query
    $resultado = mysqli_query($conn, $sql);
    foreach($pedidos as $pedido){
        $pedidoId = $pedido[0];
      
        
        
    }
  

    // verifica se houveram resultados
    if (mysqli_num_rows($resultado) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>E-mail do usuario</th>";
        echo "<th>Pedido</th>";
        echo "<th>Data da criação</th>";
        echo "<th>Status</th>";
        echo "<th>Ultima atualização</th>";
        echo "<th>Total</th>";
        echo "<th>Concluir</th>";
        echo "</tr>";

        // output data of each row
        $i=0;
        while ($row = mysqli_fetch_assoc($resultado)) {
            
            ?>
            <tr>
            <td><?php echo $row["pedidoId"]; ?> </td>
            <td><?php echo $row["email"]; ?> </td>
            <td><?php echo $row["lanches"] ;?> </td>
            <td><?php echo $row["criacao_pedido"]; ?> </td>
            <td><?php echo $row["status"]; ?> </td>
            <td><?php echo $row["ultima_atualizacao"]; ?> </td>
            <td><?php echo $row["preco"]; ?> </td>
            <td><?php echo "R$" . $row["preco"] . ",00" ?> </td>
            <td>      <select name="<?php echo $pedidos[$i][0]; ?>status" id="<?php echo $pedidos[$i][0]; ?>status"  placeholder="">
                                <option value='<?php echo $row["status"]; ?>' selected hidden><?php echo $row["status"]; ?></option>
                                <option value='Aceito'>Aceito</option>
                                <option value='Em preparo'>Em preparo</option>
                                <option value='Enviado'>Enviado</option>
                                <option value='Concluido'>Concluido</option>
                            </select> 

                </td> 
            </tr>
            <?php
      
            $i++;
        }
        echo "</table>";
    } else {
        echo "Nenhum resultado encontrado.";
    }
    $querryQtd = "SELECT COUNT(*) AS qtd FROM pedidos WHERE NOT status = 'Concluido'";
    $resultQtd = mysqli_query($conn, $querryQtd);
    $qtd = mysqli_fetch_assoc($resultQtd);
    
    for($i=0; $i<$qtd['qtd']; $i++){
      
        if(isset($_POST['alterarStatus'])){
            $stringNome =$pedidos[$i][0].'status';
            $varivalStatus= $_POST[$stringNome];
       
            $id = $pedidos[$i][0];
            $sql = "UPDATE pedidos SET status = '$varivalStatus', ultima_atualizacao = NOW() WHERE pedidoId = '$id'";
            $result = mysqli_query($conn, $sql);
            if($result){
               // echo "Status alterado com sucesso";
               header("Refresh:0");
            }else{
                echo "Erro ao alterar status";
            }
        }
    }
    
    ?>
  
       <input type="submit" name="alterarStatus" value="Alterar">
    </form>
</body>

</html>