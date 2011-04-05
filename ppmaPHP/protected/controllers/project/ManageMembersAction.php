<?php
class ManageMembersAction extends CAction
{
	public function run()
		{
			
			if(isset($_GET['add'])){
				$newMember = User::model()->findByPk($_GET['add']);
				if(null != $newMember){
					$connection=Yii::app()->db;
					$sql = 'INSERT INTO projectMember (pid, uid) VALUES('.$_GET['id'].','. $_GET['add'] .')';
					$command=$connection->createCommand($sql);
					$command->execute();
				}
				else{
					$cs = Yii::app()->clientScript;
  					$cs->registerScript('error', 'alert("User with id '.$_GET['add'].' does not exist!");', CClientScript::POS_READY);
					
				}
			}
			
			if(isset($_GET['del'])){
		
				$connection=Yii::app()->db;
				$sql = 'DELETE FROM projectMember WHERE pid='.$_GET['id'].' AND  uid='. $_GET['del'];
				$command=$connection->createCommand($sql);
				$res = $command->query();
				
			}
			
			$controller = $this->controller;
			
			$model = $controller->loadModel($_GET['id']);
			
			$controller->render('project/manageMembers',array(
				'model'=>$model,		
			));
			
			
			
			}
}
?>