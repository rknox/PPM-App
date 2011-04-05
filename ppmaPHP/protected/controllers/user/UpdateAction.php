<?php
class UpdateAction extends CAction
{
	public function run()
	{
		$controller = $this->controller;
		$model=$controller->loadModel($_GET['id']);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$controller->redirect(array('user/view','id'=>$model->id));
		}

		$controller->render('user/update',array(
			'model'=>$model,
		));
	}
}