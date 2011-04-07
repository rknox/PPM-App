<?php

class GroupController extends Controller{
	
	public function GroupController()
	{
		$this->defaultAction = 'list';
	}
	
	public function actions()
	{
		$path = 'application.controllers.group.';
		return Array(
			'create' 	=> $path.'CreateAction',
			'delete' 	=> $path.'DeleteAction',
			'update' 	=> $path.'UpdateAction',
			'list' 		=> $path.'ListAction',
			'view' 		=> $path.'ViewAction',
			'deleteMember' => $path.'DeleteMemberAction'
		);
	}
	
	public function loadModel($id){
		$group = Group::model()->findByPk($id);
		return $group;
	}
	
	public function filters()
	    {
	        return array(
	            'accessControl',
	        );
	    }
    
    public function accessRules()
    {
    	return array(
    		array('allow',
            	'actions'=>array('create', 'delete', 'update', 'list'),
                'users'=>array('@'),
    			'expression'=>'(Yii::app()->user->object->hasAccsess(Array(\'admin\')))',
            ),
    		array('deny',
                'actions'=>array('create', 'delete', 'update', 'list'),
                'users'=>array('*'),
            ),
    	);
    }
	
	
}