<?php
class ProjectController extends Controller{
	
	public $model;
	
	public function ProjectController()
	{
		$this->defaultAction = 'list';
	}
	
	public function loadModel($id)
	{	
		$model=Project::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function  actions()
	{
		return array(
		'create'=>'application.controllers.project.CreateAction',
		'delete'=>'application.controllers.project.DeleteAction',
		'update'=>'application.controllers.project.UpdateAction',
		'list'=>'application.controllers.project.ListAction',
		'view'=>'application.controllers.project.ViewAction',
		'vote'=>'application.controllers.project.VoteAction',
		'deleteGroup'=>'application.controllers.project.DeleteGroupAction',
		);
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
    			'expression'=>'(Yii::app()->user->object->hasAccsess(Array(\'user\', \'admin\')))',
            ),
    		array('deny',
                'actions'=>array('create', 'delete', 'update', 'list'),
                'users'=>array('*'),
            ),
    	);
    }
	
}