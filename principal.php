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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Ortifruit Herplim</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="home-bg">
        <section class="home">
            <div class="content">
                <span>Não entre em pânico, vá orgânico</span>
                <h3>Alcance uma vida mais saudável com alimentos orgânicos</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit omnis asperiores tempora sequi ex, animi molestias voluptates praesentium amet dolorem delectus laboriosam fuga reprehenderit quibusdam quia vero rerum in velit.</p>
                <a href="about.php" class="btn">Sobre nós</a>
            </div>
        </section>
    </div>
    <section class="home-category">
        <h1 class="title">Compre por categoria</h1>
        <div class="box-container">
            <div class="box">
                <img src="img/cat-1.png" alt="">
                <h3>Frutas</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo veritatis hic vel suscipit impedit quibusdam.</p>
                <a href="category.php?category=fruits" class="btn">Frutas</a>
            </div>
            <div class="box">
                <img src="img/cat-2.png" alt="">
                <h3>Carne</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo veritatis hic vel suscipit impedit quibusdam.</p>
                <a href="category.php?category=meat" class="btn">Carne</a>
            </div>
            <div class="box">
                <img src="img/cat-3.png" alt="">
                <h3>Vegetais</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo veritatis hic vel suscipit impedit quibusdam.</p>
                <a href="category.php?category=vegitables" class="btn">Vegetais</a>
            </div>
            <div class="box">
                <img src="img/cat-4.png" alt="">
                <h3>Peixes</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo veritatis hic vel suscipit impedit quibusdam.</p>
                <a href="category.php?category=fish" class="btn">Peixes</a>
            </div>
        </div>
    </section>
    <section class="products">
        <h1 class="title">Produtos mais recentes</h1>
        <div class="box-container">
            <?php
                $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
                $select_products->execute();
                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" class="box" method="POST">
                <div class="price">R$<?= $fetch_products['price']; ?></div>
                <a href="view_page.php?pid=<?= $fetch_products['id']; ?>"  class="fas fa-eye"></a>
                <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                <div class="name"><?= $fetch_products['name']; ?></div>
                <input type="hidden" name="p_id" value="<?= $fetch_products['id']; ?>">
                <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
                <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
                <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
                <input type="number" name="p_qty" value="1" min="1" class="qty">
                <input type="submit" value="Adicionar a lista de desejos" class="option-btn" name="add_to_wishlist">
                <input type="submit" value="Adicionar no carrinho" class="option-btn" name="add_to_cart">
            </form>
            <?php
                }
            }else{
                echo '<p class="empty">Nenhum produto adicionado!</p>';
            }
            ?>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>
