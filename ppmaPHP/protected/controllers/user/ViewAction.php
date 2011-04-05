<?php
class ViewAction extends CAction
{
	public function run()
	{
		$controller = $this->controller;
		$controller->render('user/view',array(
			'model'=>$controller->loadModel($_GET['id']),
		));
	}
}