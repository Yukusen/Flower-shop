<?php 
include 'connection.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
header('location:login.php');
}
if (isset($_POST['logout'])) {
session_destroy();
header('location:login.php');
}
/*-------------delete orders to db-------------*/
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM orders WHERE id='$delete_id'") or die('query failed');
 
    header('location:admin_orders.php');
    }
    /*-------------update order to db-------------*/
    if (isset($_POST['update_order'])){
        $order_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];

        mysqli_query($conn, "UPDATE orders SET payment_status='$update_payment' WHERE id='$order_id'") or die('query failed');
        $message[] = 'Статус оплаты обновлен';
    }
	if (isset($_POST['update_order'])){
		$update_p_id = $_POST['update_p_id'];
		$update_p_name = $_POST['update_p_name'];
		$update_p_number = $_POST['update_p_number'];
		$update_p_email = $_POST['update_p_email'];
		$method = mysqli_real_escape_string($conn, $_POST['method']);
		$update_p_address = $_POST['update_p_address'];
		$update_p_total_products = $_POST['update_p_total_products'];
		$update_p_total_price = $_POST['update_p_total_price'];
  
		$update_query = mysqli_query($conn,"UPDATE orders SET id='$update_p_id', name='$update_p_name', number='$update_p_number', method='$method', email='$update_p_email', total_price='$update_p_total_price', address='$update_p_address', total_products='$update_p_total_products' WHERE id='$update_p_id'") or die('query failed');
		$message[] = 'Букет обновлен';
		header('location:admin_orders.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/png" href="/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администратор</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
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
<section class="order_container">
    <h1 class="title">Все размещенные заказы</h1>
    <div class="box-container">
        <?php 
        $select_orders = mysqli_query($conn, "SELECT * FROM orders") or die('Error');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
        
        ?>
        <div class="box">
            <p>Имя: <span><?php echo $fetch_orders['name'] ?></span></p>
            <p>id пользователя: <span><?php echo $fetch_orders['user_id'] ?></span></p>
            <p>Дата добавления заказа: <span><?php echo $fetch_orders['placed_on'] ?></span></p>
            <p>Номер телефона: <span><?php echo $fetch_orders['number'] ?></span></p>
            <p>Почта: <span><?php echo $fetch_orders['email'] ?></span></p>
            <p>Цена заказа: <span><?php echo $fetch_orders['total_price'] ?></span></p>
            <p>Метод оплаты: <span><?php echo $fetch_orders['method'] ?></span></p>
            <p>Адрес: <span><?php echo $fetch_orders['address'] ?></span></p>
            <p>Всего букетов: <span><?php echo $fetch_orders['total_products'] ?></span></p>
            <form method="post">
			<a href="admin_orders.php?edit=<?php echo $fetch_orders['id'] ?>" class="edit">Изменить</a>
                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']?>">
				<p>Статус оплаты:</p>
                <select name="update_payment">
                    <option disabled selected><?php echo $fetch_orders['payment_status']?></option>
                    <option value="Ожидание">Ожидание</option>
                    <option value="Выполненно">Выполненно</option>
                </select>
				
                <input type="submit" name="update_order" value="Обновить" class="btn">
                <a href="admin_orders.php?delete=<?php echo $fetch_orders['id'] ?>" class="delete" onclick="return confirm('delete this')">Удалить</a>
            </form>
        </div>
        <?php 
            }
        }
        ?>
    </div>
</section>
<section class="update-container">
<?php
if(isset($_GET['edit'])){
$edit_id = $_GET['edit'];
$edit_query = mysqli_query($conn, "SELECT * FROM orders WHERE id = $edit_id") or die('query failed');
if(mysqli_num_rows($edit_query) > 0){
  while($fetch_edit  = mysqli_fetch_assoc($edit_query)){
?>
<form method="post" action="" enctype="multipart/from_data">
		<input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id'];?>">
		<input type="text" name="update_p_name" value="<?php echo $fetch_edit['name'];?>" placeholder="Введите имя">
		<input type="text" name="update_p_number" value="<?php echo $fetch_edit['number'];?>" placeholder="Введите номер телефона">
		<input type="email" name="update_p_email" value="<?php echo $fetch_edit['email'];?>" placeholder="Введите почту">
		<select name="method">
		<label>Метод оплаты</label>
				<option selected disabled><?php echo $fetch_edit['method'];?></option>
				<option class="cash on delivery">Наличными при получении</option>
				<option class="cradit card">Дебетовой картой</option>
				<option class="paypal">Кредитной картой</option>
				<option class="paytm">Qiwi</option>
		</select>
		<input type="text" name="update_p_address" value="<?php echo $fetch_edit['address'];?>" placeholder="Адрес">
		<input type="text" name="update_p_total_products" value="<?php echo $fetch_edit['total_products'];?>" placeholder="Всего букетов">
		<input type="number" name="update_p_total_price" value="<?php echo $fetch_edit['total_price'];?>" placeholder="Общая стоимость">
  		<input type="submit" name="update_order" value="Изменить" class="edit">
  		<input type="reset" value="Отмена" class="option_btn btn" id="close-edit">
</form>
<?php 
  }
}
echo "<script>document.querySelector('.update-container').style.display='block';</script>";
}
?>
</section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>