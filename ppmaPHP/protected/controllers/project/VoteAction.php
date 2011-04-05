<?php
class VoteAction extends CAction{
	
	public function run(){
		$controller = $this->controller;
		
		$form = new VoteForm();
		$project = $controller->loadModel($_GET['id']);

		if(Yii::app()->request->isPostRequest){
			$form->vote =  $_POST['VoteForm']['vote'];
			$form->project = $project;
			
			if($form->validate()){
				$controller->redirect(array('project/view','id'=>$project->id));
			}
			
		}
		
		$form->project = $project;
		$controller->render('project/vote', array('model'=>$form));
	}
}