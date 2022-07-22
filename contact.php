<?php
header('Content-Type: text/html; charset=utf-8');
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_POST['send'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $msg = $_POST['msg'];
    $msg = filter_var($msg, FILTER_SANITIZE_STRING);

    $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ?, email = ?, number = ?, message = ?");
    $select_message->execute([$name,$email,$number,$msg]);

    if($select_message->rowCount() > 0){
        
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
    <title>Contato</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="contact">
        <div class="title">Entrar em contato</div>
        <form action="" method="POST">
            <input type="text" name="name" class="box" required placeholder="Digitar seu nome">
            <input type="email" name="email" class="box" placeholder="Digite seu email" required>
            <input type="number" name="number" min="0" class="box" required placeholder="Digitar seu número">
            <textarea name="msg"  cols="30" rows="10" class="box" placeholder="Digiar sua mensagem" required></textarea>
            <input type="submit" value="Enviar mensagem" class="btn" name="send">
        </form>
    </section>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>


