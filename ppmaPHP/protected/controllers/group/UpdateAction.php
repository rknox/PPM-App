<?php
class UpdateAction extends CAction
{
	public function run()
	{
		$controller = $this->controller;
		$model=$controller->loadModel($_GET['id']);

		if(isset($_POST['Group']))
		{
			$model->attributes=$_POST['Group'];
			if($model->save()){
				$controller->redirect(array('group/view','id'=>$model->id));
			}
		}

		$controller->render('group/update',array(
			'model'=>$model,
		));

	}
}