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
    <title>Atualizar perfil</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <section class="update-profile">
        <h1 class="title">Atualizar perfil</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <div class="flex-btn">
                <div class="inpu-box">
                    <span>nome do usuário: </span>
                    <input type="text" name="name" value="<?= $fetch_profile['name'];?>"placeholder="Atualizar usuário" required class="box">
                    <span>email: </span>
                    <input type="email" name="email" value="<?= $fetch_profile['email'];?>"placeholder="Atualizar email" required class="box">
                    <span>atualizar foto: </span>
                    <input type="text" name="name" value="<?= $fetch_profile['name'];?>"placeholder="Atualizar usuário" required class="box">
                </div>
            </div>
        </form>
    </section>

    <script src="java/script.js"></script>
</body>
</html>

