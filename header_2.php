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
        <a href="index.php" class="logo">Ortifruit <span>Herplim</span></a>
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="shop_in.php">Loja</a>
            <a href="about.php">Sobre</a>
            <a href="contact.php">Contatos</a>
        </nav>
        <div class="icons">
            <a href="search_page.php" class="fas fa-search"></a>
        </div>
    </div>
</header>

