<?php
header('Content-Type: text/html; charset=utf-8');
@include 'config.php';

if(isset($_POST['add_to_wishlist'])){

    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    }
    
}

if(isset($_POST['add_to_cart'])){

    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    }

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
    <title>Olhada rápida</title>
</head>
<body>
    <?php include 'header_2.php'; ?>
    <section class="quick-view">
        <?php
            $pid = $_GET['pid'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$pid]);
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="title">Visualização</div>
        <form action="" class="box" method="POST">
            <div class="price">R$<?= $fetch_products['price']; ?></div>
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
            <div class="name"><?= $fetch_products['name']; ?></div>
            <div class="details"><?= $fetch_products['details']; ?></div>
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
            <input type="number" name="p_qty" value="1" min="1" class="qty">
            <input type="submit" value="Adicionar a lista de desejos" class="option-btn" name="add_to_wishlist">
            <input type="submit" value="Adicionar no carrinho" class="btn" name="add_to_cart">
        </form>
        <?php
            }
        }else{
            echo '<p class="empty">Nenhum produto adicionado!</p>';
        }
        ?>
    </section>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>

