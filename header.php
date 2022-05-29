<?php

if(isset($message)){
    foreach($message as $message){
        echo '
            <div class="message">
                <span>' . $message . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
        ';
    }
}

?>

<header class="header">
    <div class="flex">
        <a href="admin_page.php" class="logo">Ortifruit <span>Herplim</span></a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="shop.php">Loja</a>
            <a href="orders.php">Pedidos</a>
            <a href="about.php">Sobre</a>
            <a href="contact.php">Contatos</a>
        </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <div class="profile">
            <?php
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <p><?= $fetch_profile['name']; ?></p>
            <a href="admin_update_profile.php" class="btn">Atualizar perfil</a>
            <a href="logout.php" class="delete-btn">Sair</a>
            <div class="flex-btn">
                <a href="login.php" class="option-btn">Entrar</a>
                <a href="register.php" class="option-btn">Cadastrar</a>
            </div>
        </div>
    </div>
</header>

