<?php
class ListAction extends CAction
{
	
	public function run()
	{
		
		$controller = $this->controller;
		
		$dataProvider=new CActiveDataProvider('Group');
		$controller->render('group/list',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
}