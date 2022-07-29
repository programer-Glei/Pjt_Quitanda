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
    <title>Lista de Desejos</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="wishlist">
        <h1 class="title">Produtos adicionados</h1>
        <div class="box-container">
            <?php
                $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $select_wishlist->execute([$user_id]);
                if($select_wishlist->rowCount() > 0){
                    while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="POST" class="box">
                <a href="view_page.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
                <div class="price">R$ <span><?= $fetch_wishlist['price']; ?></span> </div>
                <img src="uplaoded_img/<?= $fetch_wishlist['image']; ?>" alt="">
                <div class="name"><?= $fetch_wishlist['name']; ?></div>
                <input type="number" name="1" value="1" class="qty" name="qty">
                <input type="hidden" name="id" value="<?= $fetch_wishlist['id'];?>">
                <input type="hidden" name="name" value="<?= $fetch_wishlist['name'];?>">
                <input type="hidden" name="price" value="<?= $fetch_wishlist['price'];?>">
                <input type="hidden" name="image" value="<?= $fetch_wishlist['image'];?>">
                <input type="submit" value="Adicionar ao carrinho" name="add_to_cart">
            </form>
            <?php 
                }
            }else{
                echo '<p class="empty">Sua Lista de Desejos está vazia</p>';
            }
            ?>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>



