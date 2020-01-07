<?php
	require_once "database.php";
	require "model/User.php";
	require "model/Honda_Moto.php";
	require "model/Kawasaki_Moto.php";
	// require "model/Cart.php";


	
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
	 echo $sql1;
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
	<title>My Moto</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
	<div class="header">
		<h1 class="brand">My Moto</h1>
		<div class="center">
			<a href="#"> Du an</a> &ensp;
			<a href="#"> Bang gia</a>&ensp;
			<a href="#"> San Pham</a>&ensp;
			<a href="#"> Khuyen Mai</a>&ensp;
			<a href="#"> Tin tuc</a>&ensp;
			<a href="#"> Co to chuc</a>&ensp;
			<a href="lienhe.html"> Lien he</a>&ensp;

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
				<div class="user-info">
					<marquee><p class="name">Hello <?php echo $user->fullName ?></p></marquee>
					<div class="cart-info">
						<button class="cart" onclick="DisplayCart()" name="cart">Cart</button>
						<span class="cart-number"><?php echo $rows ?></span>
					</div>
					<form action="index.php">
						<button>Logout</button>
					</form>
				</div>
		<?php 
			}
		?>
	</div>
	<!-- <div id="giaodien"> -->
	<div class= "header1">
		<img  style ="width:100%; height: 500px;"src="images/moto/header.jpg">
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
    <form id="DisplayCart" method="post" style="display: none;">
    	<table>
    		<tr>
    			<th> ID</th>
    			<th>Name</th>
    			<th>Price</th>
    			<th>Image</th>
    			<th> Quantity</th>
    			<th> Total </th>
    			<<th> Action</th>
    		</tr>
    		<?php
    			for($i=0;$i<count($result1);$i++){
    		?>
    			
    		<tr>
    			<td> <?php echo $result1[$i][0] ?> </td>
                <td><img  src="<?php echo $result1[$i][3] ?>" style="width:20px ; height: 20px" alt="Image"></td>
                <td><?php echo $result1[$i][1] ?></td>
                <td><?php echo $result1[$i][2] ?></td>
    			<td><form method="post"><input type="number" name="quantity"></form></td>
    			<td> <?php  
    			if(isset($_POST["quantity"])) 
    					$_POST["quantity"]*$result[$i][2] 
    				
    				?>  </td>
    			<td><button class="delete" name="id_cart" value="<?php echo $result1[$i][0];?>">Delete</button></td>
    		</tr>
    		<?php
    	}
    		?>
    	</table>
    	<div class="pay">
		    <h1>CỘNG GIỎ HÀNG</h1>
		    <p>Tạm tính: <?php echo sum($result1);?></p>
		    <p>Phí giao hàng: <?php echo (sum($result1)*0.01);?></p>
		    <p>Tổng: <?php echo (sum($result1)+(sum($result1)*0.01));?></p>
		    <form action = "" method="post">
		    <button style="text-align: center;" name="order">Thanh toán</button>
		    </form>
    	</div>
    </form>
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