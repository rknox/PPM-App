<?php
class DeleteAction extends CAction
{
	public function run(){
		$controller = $this->controller;
		$controller->loadModel($_GET['id'])->delete();
		$controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('project/list'));

	}
}	
