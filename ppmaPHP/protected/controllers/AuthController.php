<?php
class AuthController extends Controller{
	
	public $model;
	
	public function AuthController()
	{
		$this->defaultAction = 'login';
	}
	
	public function  actions()
	{
		return array(
			'login'=>'application.controllers.auth.LoginAction',
			'logout'=>'application.controllers.auth.LogoutAction',
		);
	}
	
}