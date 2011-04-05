<?php

class VoteForm extends CFormModel{
	
	public $name;
	public $project;
	public $vote;
	
	
	public function rules(){
		return array(
			array('$vote', 'storeVoteToDb'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'vote' => 'vote',
			'title'=>'title',
			
		);
	}
	
	public function storeVoteToDb(){
		$user = User::model()->findByAttributes(array('email'=>Yii::app()->user->name));
		if($this->project->hasUserVoted($user->id, $this->project->id)){
			$this->addError('user', "You already participated in the vote. Please return to the project.");
		}
		else{
			$this->project->vote($this->vote, $user->id);
		}
	}
}


