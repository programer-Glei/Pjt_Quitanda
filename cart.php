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
    <title>Carinho de compras</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="shopping-cart">
        <h1 class="title">Produtos adicionados</h1>
        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if($select_cart->rowCount() > 0){
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="POST" class="box">
                <a href="cart.php?delete=<?=$fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('excluir isso do carrinho?');"></a>
                <a href="view_page.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
                <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                <div class="name"><?= $fetch_cart['name']; ?></div>
                <div class="price">R$ <?= $fetch_cart['price']; ?></div>
                <input type="hidden" name="pid" value="<?= $fetch_cart['pid'];?>">
                <input type="hidden" name="p_name" value="<?= $fetch_cart['name'];?>">
                <input type="hidden" name="p_price" value="<?= $fetch_cart['price'];?>">
                <input type="hidden" name="p_image" value="<?= $fetch_cart['image'];?>">
                <div class="flex-btn">
                    <input type="number" min="1" value="<?= $fetch_cart['quantity'] ?>" class="qty" name="p_qty">
                    <input type="submit" value="Atualizar" name="update_qty" class="option-btn">
                </div>
                <div class="sub-total"> Sub total: R$ <span><?=$sub_total =  ($fetch_cart['price'] * $fetch_cart['quantity']);?></span> </div>
            </form>
            <?php
                $grand_total += $fetch_cart['price'];
                }
            }else{
                echo '<p class="empty">Sua Lista de Desejos está vazia</p>';
            }
            ?>
        </div>
        <div class="cart-total">
            <p>Geral total: <span>R$<?= $grand_total;?></span></p>
            <a href="shpo.php" class="option-btn">Continue comprando</a>
            <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled';?>">Deletar todos</a>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>




