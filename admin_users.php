<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

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
    <title>Usuários</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="user-accounts">
        <h1 class="title">Contas de usuário</h1>
        <div class="box-container">
            <?php
                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();
                while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box">

            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="java/script.js"></script>
</body>
</html>

