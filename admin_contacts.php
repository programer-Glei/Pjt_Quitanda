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
    <title>Mensagens</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <section class="messages">
        <div class="title">Mensagens</div>
        <div class="box-container">
            <?php
                $select_message = $conn->prepare("SELECT * FROM `message`");
                $select_message->execute();
                if($select_message->rowCount() > 0){
                    while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){

                    }
                }else{
                    echo '<p class="empty">Você não tem mensagens</p>';
                }
            ?>
        </div>
    </section>

    <script src="java/script.js"></script>
</body>
</html>

