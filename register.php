<?php

include 'config.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = $_POST['cpass'];
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
    $user_type = 'user';

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select->execute([$email]);

    if($select->rowCount() > 0){
        $message[] = 'e-mail do usuário já existe!';
    }else{
        if($pass != $cpass){
            $message[] = 'A confirmação da senha tá diferente!';
        }else{
            $insert = $conn->prepare("INSERT INTO `users`(name,email,password,user_type,image) VALUES(?,?,?,?,?)");
            $insert->execute([$name,$email,$pass,$user_type,$image]);
            if($insert){
                if($image_size > 2000000){
                    $message[] = 'imagem é muito grande!';
                }else{
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[] = 'Registrado com sucesso!';
                    header('location:login.php');
                }
            }
        }
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
    <title>Cadastro & Login</title>
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
            <h3>Cadastrar</h3>
            <input type="text" name="name" class="box" placeholder="Digite seu nome" required>
            <input type="email" name="email" class="box" placeholder="Digite seu email" required>
            <input type="password" name="pass" class="box" placeholder="Digite sua senha" required>
            <input type="password" name="cpass" class="box" placeholder="confirme sua senha" required>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required>
            <input type="submit" value="Cadastrar agora" class="btn" name="submit">
            <p>Já tem uma conta?<a href="login.php"> Fazer login</a></p>
        </form>
    </section>
</body>
</html>
