<?php
class LoginAction extends CAction
{
	
	function run() 
	{	
		$controller = $this->controller;
		if(Yii::app()->user->isGuest){
			$controller->model = new LoginForm();
			
			// if form is submitted
			if(isset($_POST['LoginForm'])){
	    		$controller->model->attributes=$_POST['LoginForm'];
		    	// validate the model
		    	if($this->controller->model->validate())
		    	{
		            Yii::app()->user->login($controller->model->identity);
		            $controller->redirect(Yii::app()->user->returnUrl);
		    	}
			}
	
	        // else render the login form    
	    	$controller->render('auth/login');
		}
		else
		{
			$controller->redirect('project');
		}
	}
}