<?php
class DeleteGroupAction extends CAction
{
	public function run(){
		$controller = $this->controller;
		
		$sql = "DELETE FROM group2project WHERE gid = :gid AND pid = :pid";
		$sqlQuery = Yii::app()->db->createCommand($sql);
		$sqlQuery->bindValue(":gid", $_GET['gid'], PDO::PARAM_INT);
		$sqlQuery->bindValue(":pid", $_GET['id'], PDO::PARAM_INT);
		$sqlQuery->execute();
		
		$controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('project/view/id/'.$_GET['id']));

	}
}	
?>