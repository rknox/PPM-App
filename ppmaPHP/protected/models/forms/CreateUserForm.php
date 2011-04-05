<?php

/**
 * CreateUserForm class
 * Creates a new user
 */

class CreateUserForm extends CFormModel{
	
	public $id;
	public $fistname;
	public $name;
	public $email;

	public function rules(){
		return array(
			array('firstname', 'name', 'email', 'required'),
			array('email', 'email'),
		);	
	}
	
}
