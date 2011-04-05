<?php
class ViewAction extends CAction
{
	public function run()
	{
		$controller=$this->controller;
		$controller->render('project/view',array(
			'model'=>$controller->loadModel($_GET['id']),
		));
	}
}