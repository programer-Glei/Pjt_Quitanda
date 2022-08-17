<?php
header('Content-Type: text/html; charset=utf-8');
include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select->execute([$email, $pass]);
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if($select->rowCount() > 0){

        if($row['user_type'] == 'admin'){

            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');

        }elseif($row['user_type'] == 'user'){

            $_SESSION['user_id'] = $row['id'];
            header('location:principal.php');
        }else{
            $message[] = 'Nenhum usuário encontrado!';
        }
    }else{
        $message[] = 'senha ou email incorretos!';
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
    <title>Login</title>
</head>
<body>

    <?php
    
    if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
    
    ?>
    <section class="form-container">
        <form action="" enctype="multipart/form-data" method="POST">
            <h3>Login</h3>
            <input type="email" name="email" class="box" placeholder="Digite seu email" required>
            <input type="password" name="pass" class="box" placeholder="Digite sua senha" required>
            <input type="submit" value="Entrar agora" class="btn" name="submit">
            <p>Não tem conta?<a href="register.php"> Cadastre-se</a></p>
        </form>
    </section>
</body>
</html>

