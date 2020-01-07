<?php
	require_once "Moto.php";
	class HondaMoto extends Moto{
		function getType(){
			return "Honda Motor";
		}

		function getImagePath(){
			return "images/moto/".$this->image.".jpg";
		}

		function getDisplayPrice(){
			return ($this->price*80/100)." VND "."(-20%) ";
		}
		function getDisplayOldPrice(){
			return ($this->price * 120/100)." VND ";
		}
	}

