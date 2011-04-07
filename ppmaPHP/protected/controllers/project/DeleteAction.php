<?php
class DeleteAction extends CAction
{
	public function run(){
		$controller = $this->controller;
		$id = $_GET['id'];
		$res = new Resources;
		Resources::deleteResourceSchedule('Employees', $id);
		Resources::deleteResourceSchedule('Hardware', $id);
		Resources::deleteResourceSchedule('Facilities', $id);
		Resources::deleteResourceSchedule('CustomResources', $id);

		$controller->loadModel($id)->delete();
		$controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('project/list'));

	}
	

}	
