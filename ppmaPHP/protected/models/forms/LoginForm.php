<?php

class LoginForm extends CFormModel
{
	
	public $email;
	public $password;
	
	public $identity;

	public function rules(){
		return array(
			array('password, email', 'required'),
			array('email', 'email'),
			array('password', 'authenticate'),
		);
	}
		
	public function authenticate($attribute, $params){
		
		$this->identity = new UserIdentity($this->email, $this->password);
			
		if(!$this->identity->authenticate()){
			$this->addError('password', 'Incorrect email or password');
		}
	}
			
}
