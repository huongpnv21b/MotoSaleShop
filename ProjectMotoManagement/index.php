<?php
	require_once "database.php";
	require "model/User.php";
	require "model/Honda_Moto.php";
	require "model/Kawasaki_Moto.php";
	// require "model/Cart.php";

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

			$sql= "INSERT INTO  users(username,password,fullName,role) 
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

    $sql = "SELECT * from users";
    $result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

     function sum($result1){
        $sum=0;
        for($i = 0; $i < count($result1); $i++) {
            $sum+=$result1[$i][5];
        }
        return $sum;
    }

    //delete//    

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
	<div class="header">
		<h1 class="brand">My Moto</h1>
		<div class="center">	
			<img style="width: 180px; height: 50px;"src="images/moto/logo.png" alt="Not found pictủe">
			<a href="#">Trang chu &ensp;|&ensp;</a>
			<a href="#">Honda &ensp;|&ensp;</a>
			<a href="#">Kawasaki &ensp; |&ensp;</a>
			<a href="#">Thong tin &ensp;|&ensp;</a>
			<a href="lienhe.php">Lien he &ensp; |&ensp;</a>
		</div>
		<?php 
			require"login.php";
			if($user == null) {
		?>		
				<div>
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
					<form action="index.php">
						<button>Logout</button>
					</form>
				</div>
	</div>
	<!-- <div id="giaodien"> -->
		<div>
		<img class="nature" src="images/slide/hinh1.jpg" width="100%" height="500px">
		<img class="nature" src="images/slide/hinh2.jpg" width="100%"height="500px">
		<img class="nature" src="images/slide/hinh3.jpg" width="100%" height="500px">
		<img class="nature" src="images/slide/hinh4.jpg" width="100%" height="500px">
		<img class="nature" src="images/slide/hinh5.jpg" width="100%" height="500px">
		<img class="nature" src="images/slide/hinh6.jpg" width="100%" height="500px">

		<script>
		w3.slideshow(".nature", 3000);
		</script>
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

    <form id="edit-form" method="post" style="display: none;">
		<h1>Edit</h1>
		<input type="text" name="name" placeholder="Username">
        <input type="text" name="price" placeholder="Price">
		<input type="text" name="type" placeholder="Type">
		<button name='update'>Update</button>
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
    			<td><form method="post"><input type="text" name="quantity"></form></td>
    			<td>
    				<button class="delete" name="id_cart" value="<?php echo $result1[$i][0];?>">Delete</button></td>
    		</tr>
    		<?php
    	}
    		?>
    	</table>
    		<button onclick="OK()">OK</button>
    </form>
    <div  id="sumcart" class="pay">
		    <h1>CỘNG GIỎ HÀNG</h1>
		    <p>Tạm tính:  <?php  
    			if(isset($_POST["quantity"])){ 
    					echo $_POST["quantity"]*$result[$i][2] ;
    				}
    				?>
		    </p>
		    <p>Phí giao hàng: <?php  echo $chiphi=$tien*0.10 ?></p>
		    <p>Tổng: <?php echo ($tien+$chiphi);?></p>
		    <form action = "" method="post">
		    <button style="text-align: center;" name="order">Thanh toán</button>
		    </form>
    	</div>
    </center>
    <!-- <div class="div">

		<img src="images/moto/moto1.jpg" alt=" Update image ">

    </div> -->
	<div class="footer">
		
			<p>Liên hệ</p>
			<p> <img src="images/moto/address.png"> &emsp; 101B Le Huu Trac,phuong Phuoc My,quan Son Tra, TP.Da Nang</p>
			<p><img src="images/moto/telephone.png">&emsp; 035.3956.450</p>
			<p><img src="images/moto/gmail.png">&emsp;hoanghuongnguyen2000@gmail.com</p>
		
			<center><h3 class="footer3">The Centimetre Studio © 2019 Allright Reserved. - Developed by WEB24S</h3><center>
		
		<p>Copyright by me 2019</p>
	</div>
	<script src="index.js"></script>
</body>
</html>
