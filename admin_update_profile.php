<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_POST['update_profile'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
    $update_profile->execute([$name, $email,$admin_id]);

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
            $update_image->execute([$image,$admin_id]);
            if($update_image){
                move_uploaded_file($image_tmp_name, $image_folder);
                unlink('uploaded_img/'.$old_image);
                $message[] = 'imagem atualizada com sucesso';
            };
        };
    };

    $old_pass = $_POST['old_pass'];
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
    <?php include 'admin_header.php'; ?>

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
                    <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" required class="box">
                    <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
                </div>
                <div class="inpu-box">
                    <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
                    <span>Senha antiga: </span>
                    <input type="password" name="update_pass" placeholder="Digite a senha anterior" required class="box">
                    <span>Senha Nova: </span>
                    <input type="password" name="new_pass" placeholder="Digite a senha nova" required class="box">
                    <span>Confirmar senha: </span>
                    <input type="password" name="conf_pass" placeholder="Confirmar a senha nova" required class="box">
                </div>
            </div>
            <div class="flex-btn">
                <input type="submit" class="btn" value="Atualizar perfil" name="update_profile">
                <a href="admin_page.php" class="option-btn">Voltar</a>
            </div>
        </form>
    </section>

    <script src="java/script.js"></script>
</body>
</html>

