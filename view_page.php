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
/*-----------addin products to wishlist------------*/
if  (isset($_POST['add_to_wishlist'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $wishlist_number = mysqli_query($conn,"SELECT * FROM wishlist WHERE name = '$product_name' AND user_id = '$user_id'") or die('error');
    

    if(mysqli_num_rows($wishlist_number) > 0){
        $message[] ='product already exist in wishlist';
    }else{
        mysqli_query($conn,"INSERT INTO wishlist(name,price,image,user_id,pid) VALUES('$product_name','$product_price','$product_image','$user_id','$product_id')") or die('error');
        $message[]='product added to wishlist';
    }
}
if  (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $cart_number = mysqli_query($conn,"SELECT * FROM cart WHERE name = '$product_name' AND user_id = '$user_id'") or die('errorr');

    if(mysqli_num_rows($cart_number)>0){
        $message[]='product already exist in cart';
    }else{
        mysqli_query($conn,"INSERT INTO cart(name,price,quantity,image,user_id,pid) VALUES('$product_name','$product_price','$product_quantity','$product_image','$user_id','$product_id')") or die('error!');
        $message[]='product added to cart';
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
    <title>Цветочный магазин</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>Детали букета</h1>
        <p>С любовью к цветам и клиентам - наш главный принцип!</p>
        
    </div>
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
    <div class="view_page">
        <?php 
        if(isset($_GET['pid'])){
            $pid = $_GET['pid'];
            $select_products= mysqli_query($conn, "SELECT * FROM products WHERE id= '$pid'") or die('error');
            if(mysqli_num_rows($select_products)>0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
        ?>
        <form method="post" action="" class="box">
            <img src="image/<?php echo $fetch_products['image']?>" alt="">
            <div class="price">₽<?php echo $fetch_products['price']?>/-</div>
            <div class="name"><?php echo $fetch_products['name']?></div>
            <div class="detail"><?php echo $fetch_products['product_detail']?></div>
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']?>">
            <div class="icon">
                <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                <input type="number" name="product_quantity" value="1" min="0" class="quantity">
                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
            </div>
        </form>
        <?php 
            }
        }
    }
        ?>
    </div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>