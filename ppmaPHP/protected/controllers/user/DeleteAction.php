<?php
class DeleteAction extends CAction
{
	public function run()
	{
		$controller = $this->controller;
			$controller->loadModel($_GET['id'])->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				$controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('user/list'));
	}
}