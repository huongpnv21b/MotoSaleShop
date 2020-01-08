<?php
	require_once "database.php";
	session_start();
	$user = null;
	$name = null;
	$pw = null;

	if(isset($_POST["username"]) && isset($_POST["password"])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql = "SELECT * from users where username='$username' and password='$password'";
		$user = $db->query($sql)->fetch_object("User");

			if (!$username || !$password) {
	        echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
	        exit;
	    }
    		if($user->canManageMoto()){
    			 echo($user->canManageMoto());
    			$log= true;
    			$_SESSION['log']=$log;
    			$_SESSION['name']=$username;
    		
    		}
    		 else if($user->canBuyMoto()){
    			
    			$log=false;
    			$_SESSION['log']=$log;
    			$_SESSION['name']=$username;
    		}
    		else echo"Tao tai khoan";
		if($user){
			echo "<script> alert ('Dang nhap Thanh Cong'); </script>";
       	} else {
			echo "<script> alert ('Dang nhap that bat !thu lai'); </script>";
	 		}
	}

	

	
	


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
	<form id="login-form" class="login" method="post">
		<h1>Login</h1>
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<button type="submit">Login</button>
	</form>

</body>
</html>