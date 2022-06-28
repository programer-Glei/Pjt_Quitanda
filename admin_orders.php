<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_POST['UPDATE_ORDER'])){
    $order_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    $update_payment = filter_var($update_payment, FILTER_SANITIZE);
    $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_orders->execute([$update_payment,$order_id]);
    $message[] = 'O pagamento foi atualizado';
};

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete_id'];
    $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_orders->execute([$delete_id]);
    header('location:admin_orders.php');
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
    <title>Vendas</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <section class="placed-orders">
        <h1 class="title">Pedidos feitos</h1>
        <div class="box-container">
            <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                $select_orders->execute();
                if($select_orders->rowCount() > 0){
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box">
                <p>ID do usuário: <span><?=$fetch_orders['user_id'];?></span>  </p>
                <p>Placed on: <span><?=$fetch_orders['placed_on'];?></span>  </p>
                <p>Nome: <span><?=$fetch_orders['name'];?></span>  </p>
                <p>Email: <span><?=$fetch_orders['email'];?></span>  </p>
                <p>Número: <span><?=$fetch_orders['number'];?></span>  </p>
                <p>Endereço: <span><?=$fetch_orders['address'];?></span>  </p>
                <p>Total de produtos: <span><?=$fetch_orders['total_products'];?></span>  </p>
                <p>Preço total: <span><?=$fetch_orders['total_price'];?></span>  </p>
                <p>Forma de pagamento: <span><?=$fetch_orders['total_price'];?></span>  </p>
                <form action="" method="POST">
                    <input type="hidden" name="order_id" value="<?= $fetch_orders['id'];?>">
                    <select name="update_payment" class="drop-down">
                        <option value="" selected disabled><?= $fetch_orders['payment_status'];?></option>
                        <option value="pending">Pendente</option>
                        <option value="completed">Concluída</option>
                    </select>
                    <div class="flex-btn">
                        <input type="submit" name="update_order" class="option-btn" value="Atualizar">
                        <a href="admin_orders.php?delete=<?= $fetch_orders['id'];?>" class="delete-btn" onlick="return confirm('Excluir este pedido?');">Deletar</a>
                    </div>
                </form>
            </div>
            <?php
                }
            }else{
                echo '<p class="empty">nenhum pedido feito ainda!</p>';
            }
            ?>
        </div>
    </section>

    <script src="java/script.js"></script>
</body>
</html>

