<?php
class ListAction extends CAction
{
	
	public function run()
	{
		
		$controller = $this->controller;
		
		$dataProvider=new CActiveDataProvider('Project');
		$controller->render('project/list',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
}