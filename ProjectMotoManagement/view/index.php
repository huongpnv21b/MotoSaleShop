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
	for($i = 0; $i < count($result); $i++) {
		$moto = $result[$i];
		if($moto['type'] == 'Honda Motor'){
			array_push($motos, new HondaMoto($moto['id'], $moto['name'], $moto['price'], $moto['image']));
		}
		if($moto['type'] == 'Kawasaki Motor'){
			array_push($motos, new KawasakiMoto($moto['id'], $moto['name'], $moto['price'],  $moto['image']));
        }
    }
// =================hienthicart==========
    $sql = "SELECT * from cart";
	$result1 = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

	$carts = array();
	for($i = 0; $i < count($result1); $i++) {
		$cart = $result1[$i];
		array_push($carts, new Cart($cart['id'], $cart['name'], $cart['price'], $cart['image']));
		}

// =========================update for  admin==========================
	if(isset($_POST['edit'])){
	   $name_edit=$_POST['namePr'];
	   $price_edit=$_POST['pricePr'];
		 $image_edit=$_POST['imagePr'];
		 $stm='UPDATE shoe set name="'.$name_edit.'", price='.$price_edit.', pic="Pic/'.$image_edit.'" WHERE id='.$_POST['edit'].'';
		 $db->query($stm)->fetch_all();
  
	  
	 
   }
	
// ===================register============
    if (isset($_POST["register"])){
    	
    	$username=$_POST["username"];
    	$password1=$_POST["password"];
    	$fullName=$_POST["fullname"];
    	$role=$_POST["role"];

			$sql= "INSERT INTO  user(username,password,fullName,role) 
				values('$username','$password1','$fullName','$role')";
    	$db->query($sql);
    	echo "<script> alert(' dang ki thanh cong'); </script>";		
   }
  
    if(isset($_POST["update"])){
		$name = $_POST["name"];
        $price = $_POST["price"];
        $type = $_POST["type"];
        $sql = "UPDATE moto SET name='$name' and price='$price' and type='$type'";
        $db->query($sql);
        echo $sql;
    }
    
    

	
	$resultcart = mysqli_query($db,"SELECT * FROM cart"); 
	$rows = mysqli_num_rows($resultcart); 

	 $sql1 = "SELECT * from cart";
	 // echo $sql1;
     $result1 = $db->query($sql1)->fetch_all();

    $sql = "SELECT * from user";
    $result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

		if(isset($_POST['logout'])){
	session_destroy();
	}

    if(isset($_POST["id_cart"])){
        $id = $_POST["id_cart"];
        $sql1 = "DELETE from cart where id= ".$id;
        $db->query($sql1);
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
		<h1 class="brand">My Moto</h1>
		<div class="center">
			<center>
			<img style="width: 180px; height: 50px;"src="../images/moto/logo.png" alt="Not found pictủe">
			<a href="#">Trang chu &ensp;|&ensp;</a>
			<a href="#">Honda &ensp;|&ensp;</a>
			<a href="#">Kawasaki &ensp; |&ensp;</a>
			<a href="thongtin.php">Thong tin &ensp;|&ensp;</a>
			<a href="lienhe.php">Lien he &ensp; |&ensp;</a>
			</center>	
		</div>
		<?php 
			require"login.php";
			if($user == null) {
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
						<button class="cart" onclick="DisplayCart()" name="cart">Cart</button>
						<span class="cart-number"><?php echo $rows ?></span>
					</div>
					<form method="post">
						<button type="sumit" name="logout">Logout</button>
					</form><br>
					<p style="background-color: black; color:white;">

                            <?php if(isset($_SESSION['name'])){
                            	echo ($_SESSION['name']);
                            }?>
                    </p>
		</div>
	</header>
	<!-- <div id="giaodien"> -->
		<div style="margin-left:185px;">
		<img class="nature" src="../images/slide/hinh1.jpg" width="90%" height="500px">
		<img class="nature" src="../images/slide/hinh2.jpg" width="90%"height="500px">
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
                
                for($i = 0; $i < count($motos); $i++){
            ?>
            <div class="item-moto">
                    <img class="image-moto" src=<?php echo $motos[$i]->getImagePath(); ?>>
                    <p class="item-moto-name"><?php echo $motos[$i]->name ?></p>
                    <p class="item-moto-type"><?php echo $motos[$i]->getType()?></p>
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
     <center>
    <form id="DisplayCart" method="post" style="display: none;">
    	<table>
    		<tr>
    			<th> ID</th>
    			<th>Name</th>
    			<th>Price</th>
    			<th>Image</th>
    			<th> Quantity</th>
    			<th> Total</th>
    			<th> Action</th>
    		</tr>
    		<?php
    			for($i=0;$i<count($result1);$i++){
    		?>
    			
    		<tr>
    			<td> <?php echo $result1[$i][0] ?> </td>
                <td> <?php echo $result1[$i][1] ?></td>
                <td><?php echo $result1[$i][3] ?></td>
                <td><img  src="<?php echo $result1[$i][2] ?>" style="width:20px ; height: 20px" alt="Image"></td>
    			<td><form method="post" style="display: flex;s"><input type="text" name="quantity"><button name="load" value="<?php echo $result1[$i][0] ?>"><img style="width: 20px;height: 20px;" src="images/moto/refresh.png"></button></form></td>
    			<td><?php 
    			for ($j=0; $j < count($result1); $j++) { 
    			if(isset($_POST['load'])){
    				if($result1[$i][0]==$_POST["load"]){
    			if(isset($_POST['quantity'])){
    						$sl=$_POST['quantity'];
    						echo $tt=$sl*$result1[$i][3];
    						break;
    				}}}}?>    					
    			</td>
    			<td>
    				<button class="delete" name="id_cart" value="<?php echo $result1[$i][0];?>">Delete</button></td>
    		</tr>
    		<?php
    	}
    		?>
    	</table>
    		<button onclick="OK()">OK</button>
    </form>
    <div  id="sumcart" class="pay" ">
		    <h1>CỘNG GIỎ HÀNG</h1>
		    <p>Tạm tính:  <?php  
    					echo $tt;		
    				?>
		    </p>
		    <p>Phí giao hàng: <?php  echo $chiphi=$tt*0.15 ?></p>
		    <p>Tổng: <?php echo ($tt+$chiphi);?></p>
		    <form action = "" method="post">
		    <button style="text-align: center;" name="order">Thanh toán</button>
		    </form>
    	</div>
    </center>
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
