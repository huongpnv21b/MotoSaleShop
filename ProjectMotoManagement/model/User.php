<?php
class User{
	public $password;
	public $username;
	public $role;
	public $fullName;
	function canManageMoto(){
		return $this->role == "admin";
	}
	function canBuyMoto(){
		return $this->role == "user";
	}
	
}
