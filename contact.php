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
/*-----------send message------------*/
if(isset($_POST['submit-btn'])){
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$number = mysqli_real_escape_string($conn, $_POST['number']);
	$message = mysqli_real_escape_string($conn, $_POST['message']);

	$select_message = mysqli_query($conn,"SELECT * FROM message WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$message'") or die('query failed');

	if(mysqli_num_rows($select_message)>0){
		echo 'Сообщение уже отправленно ранее';
	}else{
		mysqli_query($conn, "INSERT INTO message(user_id, name, email, number, message) VALUES('$user_id','$name','$email','$number','$message')") or die('query failed');
		echo 'Сообщение отправленно';
	}
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
    <title>Контакты</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>Контакты</h1>
        <p>Ваше настроение - наша ответственность. Мы создадим идеальный букет для вас!</p>
    </div>

	<div class="form-container">
		<div class="form-section">
			<form method="post" action="">
				<h1>Отправь свой вопрос нам!</h1>
				<p>Мы ответим вам в течении двух суток.</p>
				<div class="input-field">
					<label>Ваше имя</label>
					<input type="text" name="name">
				</div>
				<div class="input-field">
					<label>Ваша почта</label>
					<input type="text" name="email">
				</div>
				<div class="input-field">
					<label>Ваш номер</label>
					<input type="number" name="number">
				</div>
				<div class="input-field">
					<label>Сообщение</label>
					<textarea name="message"></textarea>
				</div>
				<input type="submit" name="submit-btn" class="btn" value="Отправить сообщение">
			</form>
		</div>
	</div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>