<?php 
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
header('location:login.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}
?>
<style type="text/css"><?php include 'main.css';?></style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="main.css">
	<link rel="icon" type="image/png" href="/favicon.png"/>
    <title>О нас</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>О нас</h1>
        <p>Мы предлагаем высокое качество и непревзойденный сервис, чтобы ваш опыт покупки был приятным и легким.</p>  
    </div>
	<div class="about">
    <div class="row">
		<div class="detail">
			<h1>Посети наш красивый магазин</h1>
			<p>Наш магазин — это выражение того, что мы любим делать; быть творческим с цветочными и растительными композициями. Ищете ли вы флориста для своей идеальной свадьбы или просто хотите украсить любую комнату одним из королевских предметов декора, мы можем помочь.</p>
			<a href="shop.php" class="btn2">Купить сейчас</a>
		</div>
		<div class="img-box">
			<img src="img/1.png" alt="">
		</div>
	</div>
	</div>
	<div class="banner-2">
		<h1>Позвольте нам сделать вашу свадьбу безупречной!</h1>
		<a href="shop.php" class="btnn">Купить сейчас</a>
	</div>
	<div class="services">
		<h1 class="title">Наши сервисы</h1>
		<div class="box-container">
			<div class="box">
				<i class="bi bi-percent"></i>
				<h3>-30% + БЕСПЛАТНАЯ ДОСТАВКА</h3>
				<p>Бесплатная доставка и скидка от 5000 рублей.</p>
			</div>
			<div class="box">
				<i class="bi bi-asterisk"></i>
				<h3>СВЕЖИЕ ЦВЕТЫ</h3>
				<p>Эксклюзивные свежие цветы с нашей гарантией счастья.</p>
			</div>
			<div class="box">
				<i class="bi bi-alarm"></i>
				<h3>СУПЕР ГИБКИЙ</h3>
				<p>Введите получателя, дату или цветы. Отмените заказ в любое время.</p>
			</div>
		</div>
	</div>
	<div class="stylist">
		<h1 class="title">Флорист-стилист</h1>
		<p>Познакомьтесь с командой, которая творит чудеса</p>
		<div class="box-container">
			<div class="box">
				<div class="img-box">
					<img src="img/teamm.png" alt="">
					<div class="social-links">
					<a href="https://www.instagram.com/yukusen/" target="_blank"><i class="bi bi-instagram"></i></a>
                	<i class="bi bi-youtube"></i>
                	<i class="bi bi-twitter"></i>
                	<i class="bi bi-twitch"></i>
                	<a href="https://t.me/Yukusen" target="_blank"><i class="bi bi-telegram"></i></a>
					</div>
				</div>
				<h3>Юлия</h3>
				<p>Разработчик</p>
			</div>
			<div class="box">
				<div class="img-box">
					<img src="img/teamm0.png" alt="">
					<div class="social-links">
					<a href="https://www.instagram.com/yukusen/" target="_blank"><i class="bi bi-instagram"></i></a>
                	<i class="bi bi-youtube"></i>
                	<i class="bi bi-twitter"></i>
                	<i class="bi bi-twitch"></i>
                	<a href="https://t.me/Yukusen" target="_blank"><i class="bi bi-telegram"></i></a>
					</div>
				</div>
				<h3>Алина</h3>
				<p>Разработчик</p>
			</div>
			<div class="box">
				<div class="img-box">
					<img src="img/teamm1.png" alt="">
					<div class="social-links">
					<a href="https://www.instagram.com/yukusen/" target="_blank"><i class="bi bi-instagram"></i></a>
                	<i class="bi bi-youtube"></i>
                	<i class="bi bi-twitter"></i>
                	<i class="bi bi-twitch"></i>
                	<a href="https://t.me/Yukusen" target="_blank"><i class="bi bi-telegram"></i></a>
					</div>
				</div>
				<h3>Татьяна</h3>
				<p>Разработчик</p>
			</div>
		</div>
	</div>

    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>