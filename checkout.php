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
/*-----------order placed------------*/
if (isset($_POST['order_btn'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$number = mysqli_real_escape_string($conn, $_POST['number']);
	$method = mysqli_real_escape_string($conn, $_POST['method']);
	$address = mysqli_real_escape_string($conn, 'Улица ' .$_POST['street'].','.$_POST['flate'].',|Номер квартиры:'.$_POST['apartment'].',|Номер подъезда:'.$_POST['entrance'].',|Номер этажа:'.$_POST['floor'].',|'.$_POST['city'].',|'.$_POST['state']);

	$placed_on = date('d-M-Y');

	$cart_total = 0;
	$cart_products[] = '';
	$cart_query = mysqli_query($conn, "SELECT * FROM cart where user_id = '$user_id'") or die('query failed1');

	if(mysqli_num_rows($cart_query)>0){
		while($cart_item = mysqli_fetch_assoc($cart_query)){
			$cart_products[]=$cart_item['name'].'('.$cart_item['quantity'].')'.(', ');
			$sub_total = ($cart_item['price']*$cart_item['quantity']);
			$cart_total += $sub_total;

		}
	}
	$total_products = implode('',$cart_products);
	mysqli_query($conn,"INSERT INTO orders (user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES ('$user_id','$name','$number','$email','$method','$address','$total_products','$cart_total','$placed_on')") or die('quert failed');
	mysqli_query($conn,"DELETE FROM cart WHERE user_id = $user_id");
	$message[] = 'Заказа оформлен!';
	header('location:checkout.php');
}
?>
<style type="text/css"><?php include 'main.css';?></style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="main.css">
	<link rel="icon" type="image/png" href="/favicon.png"/>
    <title>Flower shop</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>Оформление заказа</h1>
        <p>Новый день начинается с красивого букета!</p>
    </div>
	<div class="checkout-form">
		<h1 class="title">Оформление заказа</h1>
		<?php 
 if(isset($message)){
   foreach ($message as $message){
echo '
<div class="message"> 
<span>'.$message.'</span>
<i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
</div>
';
   }
 }
?>
		<div class="display-order">
			<?php 
			$select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('mysqli_error');
			$total=0;
			$grand_total = 0;
			if(mysqli_num_rows($select_cart)>0){
				while($fetch_cart=mysqli_fetch_assoc($select_cart)){
					$total_price = ($fetch_cart['price']*$fetch_cart['quantity']);
					$grand_total = $total+=$total_price;
			?>
			<span><?= $fetch_cart['name'];?>(<?= $fetch_cart['quantity']?>)</span>
			<?php
					
				}
			}
			?>
			<span class="grand-total">Общая сумма к оплате: ₽<?= $grand_total; ?></span>
		</div>
		<form method="post" action="">
		<div class="input-field">
			<label>Ваше имя</label>
			<input type="text" name="name" placeholder="Введите имя">
		</div>
		<div class="input-field">
			<label>Номер телефона</label>
			<input type="text" name="number" placeholder="Введите номер телефона">
		</div>
		<div class="input-field">
			<label>Ваша почта</label>
			<input type="email" name="email" placeholder="Введите почту">
		</div>
		<div class="input-field">
			<label>Выберите метод оплаты</label>
			<select name="method">
				<option selected disabled>Выберите метод оплаты</option>
				<option class="cash on delivery">Наличными при получении</option>
				<option class="cradit card">Дебетовой картой</option>
				<option class="paypal">Кредитной картой</option>
				<option class="paytm">Qiwi</option>
			</select>
		</div>
		<div class="input-field">
			<label>Улица:</label>
			<input type="text" name="street" placeholder="Улица">
		</div>
		<div class="input-field">
			<label>Номер дома:</label>
			<input type="text" name="flate" placeholder="Номер дома">
		</div>
		<div class="input-field">
			<label>Номер квартиры:</label>
			<input type="text" name="apartment" placeholder="Номер квартиры">
		</div>
		<div class="input-field">
			<label>Номер подъезда:</label>
			<input type="text" name="entrance" placeholder="Номер подъезда">
		</div>
		<div class="input-field">
			<label>Этаж:</label>
			<input type="text" name="floor" placeholder="Этаж">
		</div>
		<div class="input-field">
			<label>Город</label>
			<input type="text" name="city" placeholder="Город">
		</div>
		<div class="input-field">
			<label>Район</label>
			<input type="text" name="state" placeholder="Район">
		</div>
		<input type="submit" name="order_btn" class="btn" value="Заказать">
		</form>
	</div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>