<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Página de administração</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <section class="dashboard">
        <h1 class="title">Painel de controle</h1>
        <div class="box-container">
            <div class="box">
                <?php
                    $total_pendings = 0;
                    $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                    $select_pendings->execute(['pending']);
                    while($fetch_pending = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                        $total_pendings += $fetch_pending['total_price'];
                    };
                ?>
                <h3><?= $total_pendings; ?></h3>
                <p>Total pendentes</p>
                <a href="admin_orders.php">ver pedidos</a>
            </div>
            <div class="box">
                <?php
                    $total_completed = 0;
                    $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                    $select_completed->execute(['completed']);
                    while($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)){
                        $total_completed += $fetch_completed['total_price'];
                    };
                ?>
                <h3><?= $total_pendings; ?></h3>
                <p>Pedidos concluídos</p>
                <a href="admin_orders.php">ver pedidos</a>
            </div>
            <div class="box">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `products`");
                    $select_products->execute();
                    $number_of_products = $select_products->rowCount();
                ?>
                <h3><?= $number_of_products; ?></h3>
                <p>Produtos adicionados</p>
                <a href="admin_products.php">ver produtos</a>
            </div>
            <div class="box">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `products`");
                    $select_products->execute();
                    $number_of_products = $select_products->rowCount();
                ?>
                <h3><?= $number_of_products; ?></h3>
                <p>Produtos adicionados</p>
                <a href="admin_products.php">ver produtos</a>
            </div>
        </div>
    </section>

    <script src="java/script.js"></script>
</body>
</html>
