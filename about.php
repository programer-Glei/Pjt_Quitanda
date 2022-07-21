<?php
header('Content-Type: text/html; charset=utf-8');
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
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
    <title>Sobre nós</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="about">
        <div class="row">
            <div class="box">
                <img src="img/about-img-1.png" alt="">
                <h3>Porque escolher-nos?</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat eaque adipisci nemo voluptate iure? Tempora natus quas, ut a fugit repellendus perferendis expedita nesciunt quo eum adipisci voluptatibus autem distinctio!</p>
                <a href="contact.php" class="btn">Contate-nos</a>
            </div>
            <div class="box">
            <img src="img/about-img-2.png" alt="">
            <h3>o que nós fornecemos?</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat eaque adipisci nemo voluptate iure? Tempora natus quas, ut a fugit repellendus perferendis expedita nesciunt quo eum adipisci voluptatibus autem distinctio!</p>
            <a href="shop.php" class="btn">Nossa loja</a>
        </div>
        </div>
    </section>
    <section class="reviews">
        <div class="title">Comentários de clientes</div>
        <div class="box-container">
            <div class="box">
                <img src="img/pic-1.png" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum nam repellendus iure dolore soluta enim!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Jonh Deo</h3>
            </div>
            <div class="box">
                <img src="img/pic-2.png" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum nam repellendus iure dolore soluta enim!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Jonh Deo</h3>
            </div>
            <div class="box">
                <img src="img/pic-3.png" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum nam repellendus iure dolore soluta enim!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Jonh Deo</h3>
            </div>
            <div class="box">
                <img src="img/pic-4.png" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum nam repellendus iure dolore soluta enim!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Jonh Deo</h3>
            </div>
            <div class="box">
                <img src="img/pic-5.png" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum nam repellendus iure dolore soluta enim!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Jonh Deo</h3>
            </div>
            <div class="box">
                <img src="img/pic-6.png" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum nam repellendus iure dolore soluta enim!</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Jonh Deo</h3>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="java/script.js"></script>
</body>
</html>


