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

