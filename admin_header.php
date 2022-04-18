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
        <a href="admin_page.php" class="logo">Painel <span>de administração</span></a>
        <nav class="navbar">
            <a href="admin_page.php">Home</a>
            <a href="admin_products.php">Produtos</a>
            <a href="admin_orders.php">Vendas</a>
            <a href="admin_users.php">Usuários</a>
            <a href="admin_contacts.php">Contatos</a>
        </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
    </div>
</header>
