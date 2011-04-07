<?php
class DeleteAction extends CAction
{
	public function run(){
		$controller = $this->controller;
		$controller->loadModel($_GET['id'])->delete();
		$sql = "DELETE FROM user2group WHERE gid = :gid ";
		$sqlQuery = Yii::app()->db->createCommand($sql);
		$sqlQuery->bindValue(":gid", $_GET['id'], PDO::PARAM_INT);
		$sqlQuery->execute();
		
		$controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('group/list'));

	}
}	
