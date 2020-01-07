<?php
require_once "IMoto.php";
abstract class Moto implements IMoto{
	public $id;
	public $name;
	public $price;
	public $image;
	public function __construct($id,$name,$price,$image){
		$this->id=$id;
		$this->name=$name;
		$this->price=$price;
		$this->image=$image;
	}
}
?>