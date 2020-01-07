<?php
class User{
	public $password;
	public $username;
	public $role;
	public $fullName;
	// function getShortName(){
	// 	$spacePos = strpos($this->fullName, ' ');
	// 	if($spacePos){
	// 		return substr($this->fullName, 0, $spacePos);
	// 	}
	// 	return $this->fullName;
	// }
	function canManageMoto(){
		return $this->role == "admin";
	}
	function canBuyMoto(){
		return $this->role == "user";
	}
	
}
?>