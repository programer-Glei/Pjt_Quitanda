<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['add_product'])){
    $name = $_POST['name']
    $name = filter_var($name, FILTER_SANITIZE);
    $price = $_POST['price']
    $price = filter_var($price, FILTER_SANITIZE);
    $details = $_POST['details']
    $details = filter_var($details, FILTER_SANITIZE);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;
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
        <form action="" method="post" enctype="multipart/form-data">
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
                    <input type="file" class="box" required accept="image/jpg, image/jpeg, image/png">
                </div>
            </div>
            <textarea name="details" cols="30" rows="10" class="box" placeholder="Insira os detalhes do produto"></textarea>
            <input type="sumit" class="btn" value="Adicionar produto" name="add_product">
        </form>
    </section>

    <script src="java/script.js"></script>
</body>
</html>

