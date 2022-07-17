<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_POST['update_product'])){
    $pid = $_POST['pid'];
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
    $old_image = $_POST['old_image'];

    $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, price = ?, details = ? WHERE id = ?");

    $update_product->execute([$name,$category,$price,$details,$pid]);

    $message[] = 'produto atualizado com sucesso!';

    if(!empty($image)){
        if($image_size > 2000000){
            $message[] = 'imagem muito grande!';
        }else{

            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->execute([$image,$pid]);

            if($update_image){
                move_uploaded_file($image_tmp_name, $image_folder);
                unlink('uploaded_img/'.$old_image);
                $message[] = 'imagem atualizada com sucesso!';
            }
        }
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
    <title>Atualizar Produtos</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <section class="update-products">

        <h1 class="title">Atualizar produto</h1>

        <?php
            $update_id = $_GET['update'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$update_id]);
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
            <input type="text" name="name" placeholder="Digitar nome" required class="box" value="<?= $fetch_products['name']; ?>">
            <input type="number" name="price" placeholder="Digitar preço" required class="box" value="<?= $fetch_products['price']; ?>">
            <select name="category" class="box" required>
                <option selected><?= $fetch_products['category']; ?></option>
                <option value="vegitbales">Vegetais</option>
                <option value="fruits">Frutas</option>
                <option value="meat">Carne</option>
                <option value="fish">Peixe</option>
            </select>
            <textarea name="details" required class="box" placeholder="Descrição do produto" cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
            <div class="flex-btn">
                <input type="submit" class="btn" value="Atualizar produto" name="update_product">
                <a href="admin_products.php" class="option-btn">Voltar <</a>
            </div>
        </form>
        <?php
             }
            }else{
                echo '<p class="empty">nenhum produto encontrado!</p>';
            }
        ?>
    </section>

    <script src="java/script.js"></script>
</body>
</html>

