<?php
class UpdateAction extends CAction
{
	public function run()
	{
		$controller = $this->controller;
		$model=$controller->loadModel($_GET['id']);

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save()){
				$controller->redirect(array('project/view','id'=>$model->id));
			}
		}

		$controller->render('project/update',array(
			'model'=>$model,
		));

	}
}