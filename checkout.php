<?php
header('Content-Type: text/html; charset=utf-8');
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_POST['order'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address = $_POST['rua']. ', '.$_POST['n_rua']. ', '.$_POST['bairro']. $_POST['cep']. $_POST['city']. $_POST['state'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $data = date('d-M-Y');
    $payment_status = 'pendente';

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $cart_query->execute([$user_id]);
    if($cart_query->rowCount() > 0){
        while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
            $cart_products[] = $cart_item['name'].'('.$cart_item['quantity'].')';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
    $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

    if($cart_total == 0){
        $message[] = 'Seu carrinho está vazio';
    }elseif($order_query->rowCount() > 0){
        $message[] = 'Pedido já feito';
    }else{
        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on, payment_status) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $data, $payment_status]);
        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$user_id]);
        $message[] = 'Pedido feito com sucesso!';
    }
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
    <title>Revisar dados</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="display-orders">
        <?php
            $cart_grand_total = 0;
            $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart_items->execute([$user_id]);
            if($select_cart_items->rowCount() > 0){
                while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
                    $cart_total_price = $fetch_cart_items['price'] * $fetch_cart_items['quantity'];
                    $cart_grand_total += $cart_total_price;
        ?>
        <p><?= $fetch_cart_items['name']; ?><span>(<?= 'R$ ' .$fetch_cart_items['price'] .' x '. $fetch_cart_items['quantity'];?>)</span></p>
        <?php
            }
        }else{
            echo '<p class="empty">Seu carrinho está vazio</p>';
        }
        ?>
        <div class="grand-total">Total dos Produtos: <span>R$ <?= $cart_grand_total;?></span> </div>
    </section>
    <section class="checkout-orders">
        <form action="" method="POST">
            <h3>Finalize seu pedido</h3>
            <div class="flex">
                <div class="inputBox">
                    <span>Seu nome:</span>
                    <input type="text" name="name" placeholder="Digite seu nome" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Seu número:</span>
                    <input type="text" name="number" placeholder="Digite seu número" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Seu email:</span>
                    <input type="email" name="email" placeholder="Digite seu email" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Forma de pagamento:</span>
                    <select name="method" class="box" required>
                        <option value="cash_on_delivery">Dinheiro na entrega</option>
                        <option value="credit card">Cartão de credito</option>
                        <option value="paypal">Paypal</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Endereço:</span>
                    <input type="text" name="rua" placeholder="Digite sua rua" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Número da casa / apartamento:</span>
                    <input type="text" name="n_rua" placeholder="Nº da casa ou Nº do apartamento" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Bairro:</span>
                    <input type="text" name="bairro" placeholder="Seu bairro" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Cep:</span>
                    <input type="text" name="cep" placeholder="Digite seu cep" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Cidade:</span>
                    <input type="text" name="city" placeholder="Sua cidade" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Estado:</span>
                    <input type="text" name="state" placeholder="Seu estado" class="box" required>
                </div>
            </div>
            <input type="submit" name="order" value="Finalizar compra" class="btn <?= ($cart_grand_total > 1)?'':disabled;?>">
        </form>
    </section>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>




