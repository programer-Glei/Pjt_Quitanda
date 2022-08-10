<?php
header('Content-Type: text/html; charset=utf-8');
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $p_name = $_POST['p_name'];
    $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
    $p_price = $_POST['p_price'];
    $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
    $p_image = $_POST['p_image'];
    $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
    $p_qty = $_POST['p_qty'];
    $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

    $check_cart_number = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart_number->execute([$p_name,$user_id]);

    
    if($check_cart_number->rowCount() > 0){
        $message[] = 'já adicionado ao carrinho';
    }else{

        $check_wishlist_number = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
        $check_wishlist_number->execute([$p_name,$user_id]);

        if($check_wishlist_number->rowCount() > 0){
            $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
            $delete_wishlist->execute([$p_name,$user_id]);
        }

        $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
        $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
        $message[] = 'adicionado ao carrinho!';
    }

}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
    $delete_wishlist_item->execute([$delete_id]);
    header('location:wishlist.php');
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
    <title>Lista de Desejos</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="wishlist">
        <h1 class="title">Produtos adicionados</h1>
        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $select_wishlist->execute([$user_id]);
                if($select_wishlist->rowCount() > 0){
                    while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="POST" class="box">
                <a href="wishlist.php?delete=<?=$fetch_wishlist['id']; ?>" class="fas fa-times" onclick="return confirm('excluir isso da lista de desejos?');"></a>
                <a href="view_page.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
                <img src="uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="">
                <div class="name"><?= $fetch_wishlist['name']; ?></div>
                <div class="price">R$ <?= $fetch_wishlist['price']; ?></div>
                <input type="number"  value="1" class="qty" name="p_qty">
                <input type="hidden" name="pid" value="<?= $fetch_wishlist['id'];?>">
                <input type="hidden" name="p_name" value="<?= $fetch_wishlist['name'];?>">
                <input type="hidden" name="p_price" value="<?= $fetch_wishlist['price'];?>">
                <input type="hidden" name="p_image" value="<?= $fetch_wishlist['image'];?>">
                <input type="submit" value="Adicionar ao carrinho" name="add_to_cart" class="btn">
            </form>
            <?php
                $grand_total += $fetch_wishlist['price'];
                }
            }else{
                echo '<p class="empty">Sua Lista de Desejos está vazia</p>';
            }
            ?>
        </div>
        <div class="wishlist-total">
            <p>Geral total: <span>R$<?= $grand_total;?></span></p>
            <a href="shpo.php" class="option-btn">Continue comprando</a>
            <a href="wishlist.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled';?>">Deletar todos</a>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>



