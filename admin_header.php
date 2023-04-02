<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header class="header"> 
        <div class="flex">
            <a href="admin.php" class="logo">Панель <span>Администратора</span></a>
            <nav class="navbar">
                <a href="admin.php">Главная</a>
                <a href="admin_product.php">Букеты</a>
                <a href="admin_orders.php">Заказы</a>
                <a href="admin_user.php">Пользователи</a>
                <a href="admin_message.php">Сообщения</a>
            </nav>
        <div class="icons">
        <i class="bi bi-list" id="menu-btn"></i>
        <i class="bi bi-person" id="user-btn"></i>
        </div>
        <div class="user-box">
            <p>Имя пользователя : <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>Почта : <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <form method="post" class="logout">
                <button name="logout" class="logout-btn">Выйти</button>
            </form>
        </div>
</div>
    </header>
</body>
</html>