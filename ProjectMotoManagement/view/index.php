<?php
require_once "../database/database.php";
require "../model/User.php";
require "../model/Honda_Moto.php";
require "../model/Kawasaki_Moto.php";
require "../model/Cart.php";
session_start();

$sql = "SELECT * from moto";
$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

$motos = array();
for ($i = 0; $i < count($result); $i++) {
	$moto = $result[$i];
	if ($moto['type'] == 'Honda Motor') {
		array_push($motos, new HondaMoto($moto['id'], $moto['name'], $moto['price'], $moto['image']));
	}
	if ($moto['type'] == 'Kawasaki Motor') {
		array_push($motos, new KawasakiMoto($moto['id'], $moto['name'], $moto['price'],  $moto['image']));
	}
}

// =========================update for  admin==========================
if (isset($_POST['edit'])) {
	$name_edit = $_POST['namePr'];
	$price_edit = $_POST['pricePr'];
	$image_edit = $_POST['imagePr'];
	$stm = 'UPDATE shoe set name="' . $name_edit . '", price=' . $price_edit . ', pic="Pic/' . $image_edit . '" WHERE id=' . $_POST['edit'] . '';
	$db->query($stm)->fetch_all();
}

// ===================register============
if (isset($_POST["register"])) {

	$username = $_POST["username"];
	$password1 = $_POST["password"];
	$fullName = $_POST["fullname"];
	$role = $_POST["role"];

	$sql = "INSERT INTO  user(username,password,fullName,role) 
				values('$username','$password1','$fullName','$role')";
	$db->query($sql);
	echo "<script> alert(' dang ki thanh cong'); </script>";
}

if (isset($_POST["update"])) {
	$name = $_POST["name"];
	$price = $_POST["price"];
	$type = $_POST["type"];
	$sql = "UPDATE moto SET name='$name' and price='$price' and type='$type'";
	$db->query($sql);
	echo $sql;
}




$resultcart = mysqli_query($db, "SELECT * FROM cart");
$rows = mysqli_num_rows($resultcart);

$sql1 = "SELECT * from cart";
// echo $sql1;
$result1 = $db->query($sql1)->fetch_all();

$sql = "SELECT * from user";
$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['logout'])) {
	session_destroy();
}




?>

<!DOCTYPE html>
<html>

<head>
	<title>My Motor</title>
	<script src="https://www.w3schools.com/lib/w3.js"></script>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>
	<header>
		<div style="margin-left: 20px;">
			<img style="width: 180px; height: 50px;" src="../images/moto/logo.png" alt="Not found pictủe">
		</div>
		<div class="center">
			<a href="index.php">Trang chu &ensp;|&ensp;</a>
			<a href="#">Honda &ensp;|&ensp;</a>
			<a href="#">Kawasaki &ensp; |&ensp;</a>
			<a href="thongtin.php">Thong tin &ensp;|&ensp;</a>
			<a href="lienhe.php">Lien he &ensp; &ensp;</a>
		</div>
		<?php
		require "login.php";
		if ($user == null) {
		?>
			<div style="display: flex;">
				<button onclick="onLoginClicked()">Login</button>
				<button onclick="onRegisterClicked()">Register</button>
			</div>
		<?php
		} else {
		?>
		<?php
		}
		?>
		<div class="user-info">
			<div class="cart-info">
				<a href="cart.php"><button class="cart" name="cart">Cart</button></a>
				<span class="cart-number"><?php echo $rows ?></span>
			</div>
			<form method="post">
				<button type="sumit" name="logout">Logout</button>
			</form><br>
			<p style="background-color: black; color:white;">

				<?php if (isset($_SESSION['name'])) {
					echo ($_SESSION['name']);
				} ?>
			</p>
		</div>
	</header>
	<!-- <div id="giaodien"> -->
	<div style="margin-left:185px;">
		<img class="nature" src="../images/slide/hinh1.jpg" width="90%" height="500px">
		<img class="nature" src="../images/slide/hinh2.jpg" width="90%" height="500px">
		<img class="nature" src="../images/slide/hinh3.jpg" width="90%" height="500px">
		<img class="nature" src="../images/slide/hinh4.jpg" width="90%" height="500px">
		<img class="nature" src="../images/slide/hinh5.jpg" width="90%" height="500px">
		<img class="nature" src="../images/slide/hinh6.jpg" width="90%" height="500px">

		<script>
			w3.slideshow(".nature", 3000);
		</script>
	</div>
	<hr style="border: 1px solid #A4A4A4">
	<div id="show">
		<center>
			<h1> SAN PHAM NOI BAT</h1>
			<div class="moto-container">

				<?php

				for ($i = 0; $i < count($motos); $i++) {
				?>
					<div class="item-moto">
						<img class="image-moto" src=<?php echo $motos[$i]->getImagePath(); ?>>
						<p class="item-moto-name"><?php echo $motos[$i]->name ?></p>
						<p class="item-moto-type"><?php echo $motos[$i]->getType() ?></p>
						<p class="item-moto-price"><?php echo $motos[$i]->getDisplayPrice() ?></p>
						<p class="item-moto-old-price"><?php echo $motos[$i]->getDisplayOldPrice() ?></p>
					</div>
				<?php
				}
				?>

			</div>
		</center>
	</div>
	<form id="register-form" class="login" method="post" style="display: none;">
		<h1>Register</h1>
		<input type="text" name="role" placeholder="Role" required=" Vui long dien day du thong tin">

		<input type="text" name="username" placeholder="Username" required=" Vui long dien day du thong tin">
		<input type="password" name="password" placeholder="Password" required=" Vui long dien day du thong tin">
		<input type="text" name="fullname" placeholder="Fullname" required=" Vui long dien day du thong tin">
		<input type="email" name="email" placeholder="Enter your email" required=" Vui long dien day du thong tin">

		<button type="submit" class="button" name="register">Register</button>
	</form>

	<?php
	include "displayProduct.php";
	?>
	<!-- <center> -->
	<!--  <?php
			// require 'cart.php';
			?> -->
	<!-- <div style="display: flex;margin-left: 200px;">
	    <div class="b">
			<img class="img" src="images/moto/moto1.jpg" alt=" Update image ">
			<p> </p>
	    </div>
	    <div class="c">
			<img class="img" src="images/moto/moto1.jpg" alt=" Update image ">
	    </div>
	</div> -->
	<?php
	require 'footer.php';
	?>
	<script src="index.js"></script>
</body>

</html>