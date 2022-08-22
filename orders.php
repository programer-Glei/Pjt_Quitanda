<?php
header('Content-Type: text/html; charset=utf-8');
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
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
    <title>Pedidos</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="placed-orders">
        <h1 class="title">Pedidos feitos</h1>
        <div class="box-container">
            <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id= ?");
                $select_orders->execute([$user_id]);
                if($select_orders->rowCount() > 0){
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
            ?>
            <?php
                 }
                }else{
                    echo '<p class="empty">Nenhum pedido feito ainda!</p>';
                }
            ?>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>




