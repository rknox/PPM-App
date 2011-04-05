<?php
class CreateAction extends CAction
{
	public function run()
	{
		$controller = $this->controller;
		
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->password = md5($model->password);
			if($model->save())
				$controller->redirect(array('user/view','id'=>$model->id));
		}

		$controller->render('user/create',array(
			'model'=>$model,
		));
	}
}