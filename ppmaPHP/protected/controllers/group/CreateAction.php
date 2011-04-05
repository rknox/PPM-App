<?php
class CreateAction extends CAction
{
	
	public function run()
	{
		$controller = $this->controller;
		$model=new Group;

		if(isset($_POST['Group']))
		{
			$model->attributes=$_POST['Group'];

			if($model->save())
				$controller->redirect('list');
			else 
				echo('error');
		}
		else{
			$controller->render('group/create',array(
				'model'=>$model,
			));
		}

	}
}