<?php
class ViewAction extends CAction
{
	public function run()
	{
		$pid = $_GET['id'];
		$controller=$this->controller;
//		if(Project::isOwner($_GET['id'], Yii::app()->User->id)){
//				$sql = 'SELECT uid, vote FROM votings WHERE pid = '.$_GET['id'];
//				$data = Yii::app()->db->createCommand($sql)->queryAll();
//				$member = Project::getMember($_GET['id']);
//				$rawData = array();
//				for($i = 0; $i < count($member); $i++){
//					$user = User::model()->findByPk($member[$i]);
//					if(Project::hasUserVoted($user->id, $pid)){
//						$data[0][0] = $user->name;
//						$data[0][1] = $user->name;
//						$rawData[$i][0] = $data;
//						echo $user->name;
////						$rawData[1] = 
//					}
//				}
//				
//		}
//		else{
			if(Project::hasUserVoted(Yii::app()->user->id, $_GET['id'])){
				$rawData = array(
				array('id'=>1, 'voteOption'=> 'Yes', 'voteResult'=>Project::getVoteResultsPerOption($_GET['id'], 0)),
				array('id'=>1, 'voteOption'=>'No', 'voteResult'=>Project::getVoteResultsPerOption($_GET['id'], 1)),
				);
			}
			else{
				$rawData = array(
				array('id'=>1, 'voteOption'=> 'Yes', 'voteResult'=>'Please Vote first'),
				array('id'=>1, 'voteOption'=>'No', 'voteResult'=>'Please Vote first'),
				);
			}
//		}
		$dataProvider = new CArrayDataProvider($rawData, array(
//				'id'=>'id',			
			)
		);
		$m = $controller->loadModel($_GET['id']);
		$controller->render('project/view',array(
			'model'=>$controller->loadModel($_GET['id']),	
			'dataProvider'=>$dataProvider,	
		));

	}
}