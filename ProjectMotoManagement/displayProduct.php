<?php
	// require "model/Honda_Moto.php";
	// require "model/Kawasaki_Moto.php";
	require_once "database.php";

    // =======Add product of Admin========
      if(isset($_POST["add"])){
        echo "<script> alert('them thanh cong'); </script>";
        $name=$_POST["name"];
        $price=$_POST["price"];
        $type=$_POST["select"];
        $image=$_POST["img"];
    
        $sql = "INSERT into moto values(null,'".$name."',".$price.",'".$select."','images/moto/".$img."')";
        echo $sql;
        $db->query($sql);
    }


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
        label{
            color: black;
        }
        .addproduct{
            border: 1px solid black;
        }
    </style>
</head>
<body>
	<form id="display" mehtod="post">
       
        <?php 
                if (isset( $_SESSION['log'] ) ) {
                if($_SESSION['log']==true){
        ?>
        <form action ="displayProduct.php" class="addproduct" method="post">
            <label > Name product</label>&ensp;
            <input type="text" name="name"><br>
            <label > Price product</label>&ensp;
             <input type="text" name="price"><br>
            <label for="select">Type</label>&ensp;
                <select name="select" >
                    <option value="1">Honda Motor</option>
                    <option value="2">Kawasaki Motor</option>
                </select><br>
            <div class="form-group"><br>
                    <label for="img">Image Product</label>&ensp;
                    <input type="file" class="form-control-file col-md-3" name="img">
            </div>
            <button name="add">Add </button>
        </form>
        <center>
            <table>
                <caption><h1>Danh sach cac san pham </h1></caption>
                    <tr>
                        <th>image</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Old Price</th>
                        <th >Action</th>
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
                            <td width="100px;">
                                <div style="display: flex;">
                                    <button class="item-moto-edit" onclick="onEditClicked()" name="edit">Edit</button>
                                    <form  method="post">
                                        <button class="item-moto-delete" name="id_delete" value="<?php echo $i;?>">Delete <?php echo $i;?></button>
                                    </form>
                                </div>
                            </td>
                        </div>
                    </tr>
                    <?php
                     }
                    ?>
        
            </table>
        </center>
            <?php
                }else {
            ?>
            <center>
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

                <?php echo '<form action ="index.php" method="post"><input  value="' . $i . '" name="buy" hidden ><button class="item-moto-buy">Buy</button></form>';                    
                ?>
             </div>   
            <?php
                }
            }}
            ?> 
              
            </div> 
            </center>    

    </form>

<script src="index.js"></script>
</body>
</html>