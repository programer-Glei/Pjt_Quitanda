<?php
header('Content-Type: text/html; charset=utf-8');
@include 'config.php';

$search_box = '';

if(isset($_POST['add_to_wishlist'])){
    
    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    };
};

if(isset($_POST['add_to_cart'])){

    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    };
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
    <title>Página de pesquisa</title>
</head>
<body>
    <?php include 'header_2.php'; ?>
    <section class="search-form">
        <form action="" method="POST">
            <input type="text" class="box" name="search_box" placeholder="procurar produtos...">
            <input type="submit" name="search_btn" value="Procurar" class="btn">
        </form>
    </section>

    <?php
        if(isset($_POST['search_btn'])){
            $search_box = $_POST['search_box'];
            $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
        };
    ?>
    <section class="products">
        <div class="box-container">
            <?php
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%' OR category LIKE '%{$search_box}%'");
                $select_products->execute();
                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" class="box" method="POST">
                <div class="price">R$<?= $fetch_products['price']; ?></div>
                <a href="view_page_in.php?pid=<?= $fetch_products['id']; ?>"  class="fas fa-eye"></a>
                <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                <div class="name"><?= $fetch_products['name']; ?></div>
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
                echo '<p class="empty">Nenhum resultado encontrado!</p>';
            }
            ?>
        </div>
    </section>
    <?php

    ?>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>


