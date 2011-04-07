<?php
class UserController extends Controller{

	public $layout='//layouts/column2';

	public function UserController()
	{
		$this->defaultAction = 'list';
	}
	
	public function loadModel($id)
	{
		$model=User::model()->findByPk((int)$id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function  actions()
	{
		return array(
		'create'=>'application.controllers.user.CreateAction',
		'delete'=>'application.controllers.user.DeleteAction',
		'update'=>'application.controllers.user.UpdateAction',
		'list'=>'application.controllers.user.ListAction',
		'view'=>'application.controllers.user.ViewAction',
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
					'expression'=>'(Yii::app()->user->object->hasAccsess(Array(\'admin\')))',
		),
		array('deny',
	                'actions'=>array('create', 'delete', 'update', 'list'),
	                'users'=>array('*'),
		),
		);
	}

}