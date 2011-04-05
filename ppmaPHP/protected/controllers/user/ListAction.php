<?php
class ListAction extends CAction
{
	
	public function run()
	{
		
		$controller = $this->controller;
		
		$dataProvider=new CActiveDataProvider('User');
		$controller->render('user/list',array(
			'dataProvider'=>$dataProvider,
		));

	}
	
}