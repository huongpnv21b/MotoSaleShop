<!DOCTYPE html>
<html>

<head>
	<title> Lien he</title>
	<meta charshet="utf-8" />
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>
	<?php require "header.php";
	?>
	<div style="background-color:yellow;">
		<center>
			<h1> ..</h1>
		</center>
	</div>
	<div style="background-color:yellow;margin-top: 100px;">
		<center>
			<h1>LIEN HE </h1>
		</center>
	</div>
	<div style="display: flex; align-items: center;">
		<div style="margin-right: 80px; margin-left: 250px;border: 1px solid #BDBDBD;border-radius:8px;">
			<h2> Chuyen ban le moto phan khoi lon nhap khau</h2>
			<p>Tu van mua hang: 0353956450</p>
			<p> <img src="../images/moto/address.png"> &emsp; 101B Le Huu Trac,phuong Phuoc My,quan Son Tra, TP.Da Nang</p>
			<p><img src="../images/moto/telephone.png">&emsp; 035.3956.450</p>
			<p><img src="../images/moto/gmail.png">&emsp;hoanghuongnguyen2000@gmail.com</p>
		</div>
		<div style="margin-right: 50px; margin-left: 100px;border: 1px solid #BDBDBD;border-radius:6px;">
			<h2> De lai loi nhan cho chung toi</h2>
			<input type="text" name="nameCus" placeholder="Ho va ten khach hang"> &ensp; &ensp;
			<input type="text" name="email" placeholder="Dia chi email"><br><br>
			<input type="text" name="phonenumber" placeholder="So dien thoai">&ensp; &ensp;
			<input type="text" name="tieude" placeholder="Tieu de"><br><br>
			<textarea rows="4" class="form-control mb-3" cols="60" name="ghichu" placeholder="Ghi chú"></textarea><br><br>
			<center>
				<button class="button1" onclick="Guilienhe()">GỬI LIÊN HỆ</button>
			</center>
		</div>
	</div>
	<div style="background-color: #A39B9B; height: 150px;">
		<center style="font-size: 25px;justify-content: center;">
			<p>Gui email ve dia chi <span style="color: red;">hoanghuongnguyen.com.vn </span>
				<br>Hoac goi Hotline ho tro de duoc tu van ve san pham ,dich vu:<span style="color: red;"> 1800 8001 </span>(Mien phi cho tat ca cac thue bao)</p>
		</center>
	</div>
	<?php
	require "footer.php";
	?>
	<script src="index.js"></script>
</body>

</html>