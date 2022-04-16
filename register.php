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
    <section class="form-container">
        <form action="" enctype="multipart/form-data" method="POST">
            <h3>Cadastrar</h3>
            <input type="text" name="name" class="box" placeholder="Digite seu nome" required>
            <input type="email" name="email" class="box" placeholder="Digite seu email" required>
            <input type="password" name="pass" class="box" placeholder="Digite sua senha" required>
            <input type="password" name="cpass" class="box" placeholder="confirme sua senha" required>
            <input type="file" name="pass" class="box" accept="image/jpg, image/jpeg, image/png" required>
            <input type="submit" value="Cadastrar agora" class="btn" name="submit">
            <p>Já tem uma conta?<a href="login.php"> Fazer login</a></p>
        </form>
    </section>
</body>
</html>
