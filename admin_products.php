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
    <title>Produtos</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <section class="add-products">
        <h1>Adicionar novo produto</h1>
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
                <div class="inpubox">
                    
                </div>
            </div>
        </form>
    </section>

    <script src="java/script.js"></script>
</body>
</html>

