<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;

    $select_products = $conn->prepare("SELECT * FROM `products` WEHERE name = ?");
    $select_products->execute([$name]);

    if($select_products->rowCount() > 0){
        $message[] = 'nome do produto já adicionado';
    }else{
        $insert_products = $conn->prepare("INSERT INTO `products`(name,category,details,price,image) VALUES(?,?,?,?,?)");
        $insert_products->execute([$name,$category,$details,$price,$image]);

        if($insert_products){
            if($image_size > 2000000){
                $message[] = 'Imagem muito grande';
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Novo produto adicionado!';
            }
        }
    }

}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
    $select_delete_image->execute([$delete_id]);
    $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
    unlink('uploaded_img/'.$fetch_delete_image['image']);
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE `products`.`id` = ?");
    $delete_product->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE * FROM `wishlist` WHERE pid = ?");
    $delete_wishlist->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE * FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    header('location:admin_products.php');
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
    <title>Produtos</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <section class="add-products">
        <h1 class="title">Adicionar novo produto</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="flex">
                <div class="inputbox">
                    <input type="text" name="name" class="box" required placeholder="Nome do Produto">
                    <select name="category" class="box" required>
                        <option value="" selected disabled>Selecione a Categoria</option>
                        <option value="vegitbales">Vegetais</option>
                        <option value="fruits">Frutas</option>
                        <option value="meat">Carne</option>
                        <option value="fish">Peixe</option>
                    </select>
                </div>
                <div class="inputbox">
                    <input type="number" min="0" name="price" class="box" required placeholder="Insira o preço do produto">
                    <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
                </div>
            </div>
            <textarea name="details" cols="30" rows="10" class="box" placeholder="Insira os detalhes do produto"></textarea>
            <input type="submit" class="btn" value="Adicionar produto" name="add_product">
        </form>
    </section>
    <section class="show-products">
        <h1 class="title">Produtos adicionados</h1>
        <div class="box-container">
            <?php
                $show_products = $conn->prepare("SELECT * FROM `products`");
                $show_products->execute();
                if($show_products->rowCount() > 0){
                    while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box">
                <div class="price">$<?= $fetch_products['price'];?></div>
                <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                <div class="name"><?= $fetch_products['name'];?></div>
                <div class="cat"><?= $fetch_products['category'];?></div>
                <div class="details"><?= $fetch_products['details'];?></div>
                <div class="flex-btn">
                    <a href="admin_update_products.php?update=<?= $fetch_products['id'];?>" class="option-btn">Atualizar</a>
                    <a href="admin_products.php?delete=<?= $fetch_products['id'];?>" class="delete-btn" onclick="return confirm('excluir este produto?');">Deletar</a>
                </div>
            </div>
            <?php
                 }
                }else{
                    echo '<p class="empty">Produtos recentes</p>';
                }
            ?>
        </div>
    </section>
    <script src="java/script.js"></script>
</body>
</html>

