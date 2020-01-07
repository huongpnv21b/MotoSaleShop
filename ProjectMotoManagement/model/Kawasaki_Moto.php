
<?php
require_once "Moto.php";
class KawasakiMoto extends Moto {
	function getType(){
		return "Kawasaki Motor";
	}
	function getImagePath(){
  		return "images/moto/".$this->image.".jpg";
  }
  function getDisplayPrice(){
        return ($this->price * 20 / 100)." VND "." (-20%) ";
    }
  function getDisplayOldPrice(){
        return ($this->price*130/100)." VND";
     }
     
}
?>

