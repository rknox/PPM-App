<?php
class CreateAction extends CAction
{
	
	public function run()
	{
		
		$controller = $this->controller;
		$model=new Project;
		$controller->performAjaxValidation($model);

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save()){
				$controller->redirect(array('resources/create','pid'=>$model->id));
			}
			else 
				echo('error');
		}
		else{
			$controller->render('project/create',array(
				'model'=>$model,
			));
		}

	}
}