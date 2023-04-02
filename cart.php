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
/*-----------update products to cart------------*/
if(isset($_POST['update_quantity_btn'])){
    $update_quantity_id = $_POST['update_quantity_id'];
    $update_value = $_POST['update_quantity'];

    $update_query = mysqli_query($conn,"UPDATE cart SET quantity='$update_value' WHERE id='$update_quantity_id'") or die('mysqli_error');
    
    if($update_query){
        header('location:cart.php');
    }
}
/*-----------addin products to cart------------*/
/*-----------delete products from wishlist------------*/
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM cart WHERE id='$delete_id'") or die('query failed');
 
    header('location:cart.php');
}
/*-----------delete ALL from cart------------*/
if(isset($_GET['delete_all'])){

    mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'") or die('query failed');
 
    header('location:cart.php');
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
    <title>Корзина</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>Корзина</h1>
        <p>Каждый цветок - это улыбка природы. Подари ее близким вместе с нами!</p>
        
    </div>
    <div class="shop">
        <h1 class="title">Букеты добавленные в корзину</h1>
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
    <div class="box-container">
        <?php 
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id=$user_id") or die("query failed");
            if(mysqli_num_rows($select_cart)>0){
                while($fetch_cart=mysqli_fetch_assoc($select_cart)){

        ?>
        <div class="box">
            <div class="icon">
                <a href="cart.php?delete=<?php echo $fetch_cart['id'];?>" class="bi bi-x"></a>
                <a href="view_page.php?pid=<?php echo $fetch_cart['pid']?>" class="bi bi-eye-fill"></a>
            </div>
            <img src="image/<?php echo $fetch_cart['image']?>" alt="">
            <div class="price">₽<?php echo $fetch_cart['price']?>/-</div>
            <div class="name"><?php echo $fetch_cart['name']?></div>
            <form class="uppp" method="post">
                <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']?>">
                <div class="qty">
                    <input type="number" min="1" name="update_quantity" value="<?php echo $fetch_cart['quantity']?>">
                    <input type="submit" value="Обновить" name="update_quantity_btn">
                </div>
            </form>    
            <div class="total_amt">
                Стоимость корзины : <span><?php echo $total_amt = ($fetch_cart['price']*$fetch_cart['quantity']);?></span>
            </div>      
        </div>
        <?php 
            $grand_total += $total_amt;
                }
            }else{
                echo '
                <div class="empty">
                <img src="image/empty.png">
                <p>Твоя корзина пуста!</p>
                </div>
                ';
            }
        ?>
    </div>
    <div class="wishlist-total">
    <div class="dlt">
        <a href="cart.php?delete_all" class="btn2 <?php echo ($grand_total > 1)?'':'disabled'?>" onclick="return confirm('Вы хотите удалить всё из корзины?')">УДАЛИТЬ ВСЁ</a>
        </div>
        <p>Стоимость всех букетов: <span><?php echo $grand_total?> ₽</span></p>
        <a href="shop.php" class="btn2">Продолжить покупки</a>
        <a href="checkout.php" class="btn2 <?php echo ($grand_total > 1)?'':'disabled'?>" onclick="return confirm('Перейти к оформлению заказа?')">Перейти к оформлению заказа</a>
    </div>
    </div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>