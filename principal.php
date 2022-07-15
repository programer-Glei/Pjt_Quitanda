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
                <span>não entre em pânico, vá orgânico</span>
                <h3>Alcance uma vida mais saudável com alimentos orgânicos</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit omnis asperiores tempora sequi ex, animi molestias voluptates praesentium amet dolorem delectus laboriosam fuga reprehenderit quibusdam quia vero rerum in velit.</p>
                <a href="about.php" class="btn">Sobre nós</a>
            </div>
        </section>
    </div>
    <section class="home-category">
        <h1 class="title">Compre por categoria</h1>
        <div class="box-container">
            <img src="img/cat-1.png" alt="">
            <h3>Frutas</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo veritatis hic vel suscipit impedit quibusdam.</p>
            <a href="category.php?category=fruits" class="btn">Frutas</a>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>
