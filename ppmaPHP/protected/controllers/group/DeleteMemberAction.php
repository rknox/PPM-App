<?php
class DeleteMemberAction extends CAction
{
	public function run(){
		$controller = $this->controller;
		
		$sql = "DELETE FROM user2group WHERE gid = :gid AND uid = :uid";
		$sqlQuery = Yii::app()->db->createCommand($sql);
		$sqlQuery->bindValue(":gid", $_GET['id'], PDO::PARAM_INT);
		$sqlQuery->bindValue(":uid", $_GET['uid'], PDO::PARAM_INT);
		$sqlQuery->execute();
		
		$controller->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('group/view/id/'.$_GET['id']));

	}
}	
?>