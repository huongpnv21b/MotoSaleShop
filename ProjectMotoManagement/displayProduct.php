<?php
	// require "model/Honda_Moto.php";
	// require "model/Kawasaki_Moto.php";
	require_once "database.php";


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
    //==============DELETE=================
    if(isset($_POST['id_delete'])){
        $id= $_POST['id_delete'];
        $del='DELETE FROM moto WHERE id='.$id;
        $db->query($del);
    }
    
     if(isset($_POST["buy"])){
	    	$id=$_POST["buy"];
	    	// echo $id;
	    
    	$name1=$motos[$id]->name;
    	$price1=$motos[$id]->price;
    	$image=$motos[$id]->image;

     	$sql= "INSERT INTO  cart(name,price,image ) 
		 		values('$name1','$price1','$image')";
     	$db->query($sql);
         echo ($sql);
     	echo "<script> alert('them thanh cong'); </script>";
  
	  }
	



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
    <style type="text/css">
        .pay{
                width: 600px;
                position: relative;
                margin: auto;
                border-style: solid;
                border-width: 1px;
                border-radius: 5px;
                font-size: 20px;
                margin-top: 50px;
            }
    </style>
</head>
<body>
    <?php 
    // =========================update for  admin==========================
    if(isset($_POST['edit'])){
        $id=$_POST['edit'];
        $sql= 'SELECT *FROM moto where id'.$id;

       $name_edit=$_POST['namePr'];
       $price_edit=$_POST['pricePr'];
         $image_edit=$_POST['imagePr'];


         $stm='UPDATE shoe set name="'.$name_edit.'", price='.$price_edit.', pic="Pic/'.$image_edit.'" WHERE id='.$_POST['edit'].'';
         $db->query($stm)->fetch_all();
  
      
     
   }?>
       <form  method="post" style="display: none;">
        <h1>Edit</h1>
        <input type="text" name="name" placeholder="Username">
        <input type="text" name="price" placeholder="Price">
        <input type="text" name="type" placeholder="Type">
        <button name='update'>Update</button>
    </form>

	<form mehtod="post">
       
                <?php 
                        // error_reporting(0);
                        if (isset( $_SESSION['log'] ) ) {
                         if($_SESSION['log']==true){
                    ?>
                    <table>
                        <caption>Danh sach cac san pham da duoc them vao gio hang</caption>
                            <tr>
                                <th>image</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Old Price</th>
                                <th>Action</th>
                            </tr>
                            <?php 
                                        for($i = 0; $i < count($motos); $i++){
                            ?>
                            <tr>                               
                                <div class="line">
                                    <td><img style="width: 60px;height: 60px;" src=<?php echo $motos[$i]->getImagePath(); ?>></td>
                                    <td><p class="item-moto-name"><?php echo $motos[$i]->name ?></p></td>
                                    <td><p class="item-moto-type"><?php echo $motos[$i]->getType()?></p></td>
                                    <td><p class="item-moto-price"><?php echo $motos[$i]->getDisplayPrice() ?></p></td>
                                    <td><p class="item-moto-old-price"><?php echo $motos[$i]->getDisplayOldPrice() ?></p></td>
                                    <td>
                                        <button class="item-moto-edit" onclick="onEditClicked()" name="edit">Edit</button>
                                        <form method="post">
                                            <button class="item-moto-delete" name="id_delete" value="<?php echo $i;?>">Delete</button></td>
                                        </form>
                                    </td>
                                </div>
                            </tr>
                            <?php
                             }
                            ?>
                
                    </table>
                    <?php
                        }else {
                    ?>
                    
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

                        <?php echo '<form method="post"><input  value="' . $i . '" name="buy" hidden ><button class="item-moto-buy">Buy</button></form>';                    
                        ?>
                     </div>   
                    <?php
                        }
                    }}
                    ?> 
                      
                    </div>                            
    </form>

<script src="index.js"></script>
</body>
</html>