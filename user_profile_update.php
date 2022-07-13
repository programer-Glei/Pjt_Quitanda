<?php
header('Content-Type: text/html; charset=utf-8');
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_POST['update_profile'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
    $update_profile->execute([$name, $email,$user_id]);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;
    $old_image = $_POST['old_image'];

    if(!empty($image)){
        if($image_size > 2000000){
            $message[] = 'imagem muito grande';
        }else{
            $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
            $update_image->execute([$image,$user_id]);
            if($update_image){
                move_uploaded_file($image_tmp_name, $image_folder);
                unlink('uploaded_img/'.$old_image);
                $message[] = 'imagem atualizada com sucesso';
            };
        };
    };

    $old_pass = $_POST['old_pass'];
    $update_pass = $_POST['update_pass'];
    $update_pass = filter_var($update_pass, FILTER_SANITIZE_STRING);
    $new_pass = $_POST['new_pass'];
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = $_POST['conf_pass'];
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if(!empty($update_pass) AND !empty($new_pass) AND !empty($confirm_pass)){
        if($old_pass != $update_pass){
            $message[] = 'senha antiga não corresponde';
        }elseif($new_pass != $confirm_pass){
            $message[] = 'confirmação diferente de nova senha';
        }else{
            $update_pass_query = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass_query->execute([$confirm_pass, $user_id]);
            $message[] = 'atualização de senha com sucesso';
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
    <title>Atualizar perfil</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="update-profile">
        <h1 class="title">Atualizar perfil</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <div class="flex-btn">
                <div class="inpu-box">
                    <span>nome do usuário: </span>
                    <input type="text" name="name" value="<?= $fetch_profile['name'];?>"placeholder="Atualizar usuário" required class="box">
                    <span>email: </span>
                    <input type="email" name="email" value="<?= $fetch_profile['email'];?>"placeholder="Atualizar email" required class="box">
                    <span>atualizar foto: </span>
                    <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
                    <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
                </div>
                <div class="inpu-box">
                    <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
                    <span>Senha antiga: </span>
                    <input type="password" name="update_pass" placeholder="Digite a senha anterior" class="box">
                    <span>Senha Nova: </span>
                    <input type="password" name="new_pass" placeholder="Digite a senha nova" class="box">
                    <span>Confirmar senha: </span>
                    <input type="password" name="conf_pass" placeholder="Confirmar a senha nova" class="box">
                </div>
            </div>
            <div class="flex-btn">
                <input type="submit" class="btn" value="Atualizar perfil" name="update_profile">
                <a href="principal.php" class="option-btn">Voltar</a>
            </div>
        </form>
    </section>

    <script src="java/script.js"></script>
</body>
</html>


