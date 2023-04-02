<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Document</title>
</head>
<body>
    <header class="header"> 
        <div class="flex">
            <a href="index.php" class="logo">Магазин <span>Букет</span></a>
            <nav class="navbar">
                <a href="index.php">Главная</a>
                <a href="shop.php">Магазин</a>
                <a href="order.php">Заказы</a>
                <a href="about.php">О нас</a>
                <a href="contact.php">Контакты</a>
            </nav>
        <div class="icons">
        <i class="bi bi-list" id="menu-btn"></i>
        <?php
        $select_wishlist = mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id = '$user_id'") or die('mysqli_error');
        $wishlist_num_rows = mysqli_num_rows($select_wishlist);
        ?>
        <a href="wishlist.php"><i class="bi bi-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
        <?php
        $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('mysqli_error');
        $cart_num_rows = mysqli_num_rows($select_cart);
        ?>
        <a href="cart.php"><i class="bi bi-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        <i class="bi bi-person" id="user-btn"></i>
        </div>
        <div class="user-box">
            <p>Имя пользователя : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Почта : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <form method="post" class="logout">
                <button name="logout" class="logout-btn">ВЫЙТИ</button>
            </form>
        </div>
</div>
    </header>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>