<?php
// =================hienthicart==========
require_once "../database/database.php";
require "../model/Cart.php";
$sql = "SELECT * from cart";
$result1 = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

$carts = array();
for ($i = 0; $i < count($result1); $i++) {
    $cart = $result1[$i];
    array_push($carts, new Cart($cart['id'], $cart['name'], $cart['price']));
}

//==============DELETE=================
if (isset($_POST["id_cart"])) {
    $id = $_POST["id_cart"];
    $sql1 = "DELETE from cart where id= " . $id;
    $db->query($sql1);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>
    <?php
    require 'header.php';
    ?>
    <p><br><br><br></p>
    <form id="cart" method="post" style="height: 600px;">
        <center>
            <table>
                <tr>
                    <th> ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th> Quantity</th>
                    <th> Action</th>
                    <th> Total</th>
                </tr>
                <?php
                for ($i = 0; $i < count($carts); $i++) {
                ?>

                    <tr>
                        <td> <?php echo $carts[$i]->id ?> </td>
                        <td> <?php echo $carts[$i]->name ?></td>
                        <td><?php echo $carts[$i]->price ?></td>
                        <td>
                            <form method="post"><input style="width:80px;" type="text" name="quantity" value="1"><button name="load" value="<?php echo $carts[$i]->id ?>"><img style="width:20px;height:20px;" src="../images/moto/refresh.png"></button></form>
                        </td>

                        <td>
                            <button class="delete" name="id_cart" value="<?php echo $carts[$i]->id; ?>">Delete</button>
                        </td>
                        <td><?php
                            for ($j = 0; $j < count($result1); $j++) {
                                if (isset($_POST['load'])) {
                                    if ($carts[$i]->id == $_POST["load"]) {
                                        if (isset($_POST['quantity'])) {
                                            $sl = $_POST['quantity'];
                                            echo $tt = ($sl * $carts[$i]->price);
                                            break;
                                        }
                                    }
                                }
                            } ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <button onclick="OK()">OK</button>
        </center>
    </form>
    <div id="sumcart" class="pay" ">
        <center>
            <h1>CỘNG GIỎ HÀNG</h1>
            <p>Tạm tính:  <?php
                            echo $total = $tt;
                            ?>
            </p>
            <p>Phí giao hàng: <?php echo $chiphi = $tt * 0.15 ?></p>
            <p>Tổng: <?php echo ($total + $chiphi); ?></p>
            <button style=" text-align: center;" onclick="thanhtoans()">Thanh toán</button>


        </center>
    </div>
    <form id="thanhtoan" metho="post" style="display: none;">
        <input type="text" name="name" placeholder=" Enter your name">
        <input type="text" name="sdt" placeholder="Enter your phone number">
        <input type="text" name="address" placeholder="Enter your address">
        <textarea> Ghi chu</textarea>
        <button onclick="hoadon()"> Dat hang</button>
    </form>
    <div id="hoadon" style="display: none;">
        <?php
        echo "<div>";
        echo "<p> Ten cua khach hang la :</p>" + $_POST['name'];
        echo "<p> Phone cua khach hang la :</p>" + $_POST['sdt'];
        echo "<p> Address cua khach hang la :</p>" + $_POST['adrress'];
        echo "<p>  Tong tien: </p>" + ($tt + $chiphi);
        echo "</div>";
        ?>
    </div>
    <?php
    require 'footer.php';
    ?>
</body>

</html>