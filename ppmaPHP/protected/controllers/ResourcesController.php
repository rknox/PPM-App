<?php

class ResourcesController extends Controller
{
	public $model;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';




	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */

	public function accessRules()
	{
		return array(
		array('allow',
            	'actions'=>array('create', 'delete', 'update', 'index', 'view'),
                'users'=>array('@'),
    			'expression'=>'(Yii::app()->user->object->hasAccsess(Array(\'user\', \'admin\')))',
		),
		array('deny',
                'actions'=>array('create', 'delete', 'update', 'list'),
                'users'=>array('*'),
		),
		);
	}

	/**
	 * List all available resources
	 */
	public function actionIndex(){
		$empDataProvider = $this->getResourceDataProvider('Employees', null);
		$hardDataProvider = $this->getResourceDataProvider('Hardware', null);
		$facDataProvider = $this->getResourceDataProvider('Facilities', null);
		
		$this->render('index',array(
			'employees'=>$empDataProvider,
			'hardware'=>$hardDataProvider,
			'facilities'=>$facDataProvider,
		));

	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$employeeScheduleDataProvider = $this->getResourceDataProvider('EmployeeSchedule', $id);
		$hardwareScheduleDataProvider = $this->getResourceDataProvider('HardwareSchedule', $id);
		$facilityScheduleDataProvider = $this->getResourceDataProvider('FacilitySchedule', $id);
		$customResourcesDataProvider = $this->getResourceDataProvider('CustomResources', $id);

		$this->render('view', array(
			'employee'=>$employeeScheduleDataProvider,
			'hardware'=>$hardwareScheduleDataProvider,
			'facility'=>$facilityScheduleDataProvider,
			'customResources'=>$customResourcesDataProvider,
		));
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$hardware = Resources::getResourceTypes(Resources::HARDWARE_DB);
		$employees = Resources::getResourceTypes(Resources::EMPLOYEE_DB);
		$facilities = Resources::getResourceTypes(Resources::FACILITY_DB);

		$customResources = new CustomResources;
		$resourceAvailable = 1;
		$projectId = $_GET['pid'];

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['create']))
		{
			$ecounter = 0;
			$hcounter = 0;
			$fcounter = 0;
			$ccounter = 0;
			foreach($_POST as $key=>$value){
				$resource = null;
				$type = $key;
				$type = substr($type, 0, 4);
				if($value['start_date'] != ''){
					if ($type == 'Empl'){
						$resource = new EmployeeSchedule;
						
						$resource->attributes = $_POST[$key];
						$resource->employee_id = EmployeeSchedule::findAvailableEmployeeResource(Resources::EMPLOYEE_DB, $resource->start_date, $resource->end_date, $value['name']);
						$resource->pid = $projectId;
							
						if($resource->employee_id == 0){
							$resource = null;
							$resourceAvailable = 0;
						}
						
					}
					elseif ($type == 'Hard'){
						$resource = new HardwareSchedule;
						$resource->attributes = $_POST[$key];
						$resource->pid = $projectId;
						$resourceAvailable = HardwareSchedule::findAvailableHardwareResource(Resources::HARDWARE_TYPES_DB, $resource->start_date, $resource->end_date, $value['name']);
						if ($resourceAvailable == 0){
							$resource = null;
						}
						else{
							$resource->hardware_id = $resourceAvailable;
						}
					}
					elseif ($type == 'Faci'){
						$resource = new FacilitySchedule;
						$resource->attributes = $_POST[$key];
						$resource->pid = $projectId;
						$resourceAvailable = FacilitySchedule::findAvailableFacilityResource(Resources::FACILITY_TYPES_DB, $resource->start_date, $resource->end_date, $value['name']);
						if($resourceAvailable == 0){
							$resource = null;
						}
						else{
							$resource->facility_id = $resourceAvailable;
						}
					}
					elseif ($type == 'Cust'){
						$resource = new CustomResources;
						$resource->attributes = $_POST[$key];
						$resource->pid = $projectId;
						$resource->owner = Yii::app()->user->id;
						$ccounter++;
					}

					if($resource != null){
						$resource->save();
					}
				}
			};

			if($resourceAvailable > 0){
				$this->redirect(array('project/view','id'=>$projectId));
			}
		}
		$employeeNames = Resources::getResourceNames(Resources::EMPLOYEE_DB);
		$this->render('create',array(
			'employees'=>$employees,
			'employeeNames'=>$employeeNames,
			'hardware'=>$hardware,
			'facilities'=>$facilities,
			'customResources'=>$customResources,
		));
	}

	/**
	 * Updates a particular Resource-Schedule-model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$critearia = new CDbCriteria;
		$critearia->addCondition("pid = ".$id);
		$projectId = $_GET['id'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		//	if(isset($_POST['EmployeeSchedule0']) || isset($_POST['HardwareSchedule']) || isset($_POST['FacilitiesSchedule']) || isset($_POST['CustomResources0']))
		if($_POST){
			$ecounter = 0;
			$hcounter = 0;
			$fcounter = 0;
			$ccounter = 0;
			foreach($_POST as $key=>$value){
				$type = $key;
				if ($type == 'EmployeeSchedule'.$ecounter){
					$resource = EmployeeSchedule::model()->findByPk((int)$value['id']);
					$resource->attributes = $_POST[$key];
					$ecounter++;

				}
				elseif ($type == 'HardwareSchedule'.$hcounter){
					$resource = HardwareSchedule::model()->findByPk((int)$value['id']);
					$resource->attributes = $_POST[$key];
					$hcounter++;
				}
				elseif ($type == 'FacilitiesSchedule'.$fcounter){
					$resource = FacilitySchedule::model()->findByPk((int)$value['id']);
					$resource->attributes = $_POST[$key];
					$fcounter++;
				}
				elseif ($type == 'CustomResources'.$ccounter){
					$resource = CustomResources::model()->findByPk((int)$value['id']);
					$resource->attributes = $_POST[$key];
					$ccounter++;
				}
				if($value['delete']){
					$resource->delete();
				}
				else{
					$resource->save();
				}

			}

			$this->redirect(array('project/view','id'=>$projectId));
		}
		$this->render('update', array(
			'employee'=>EmployeeSchedule::model()->findAll($critearia),
			'hardware'=>HardwareSchedule::model()->findAll($critearia),
			'facility'=>FacilitySchedule::model()->findAll($critearia),
			'customResources'=>CustomResources::model()->findAll($critearia),
		));
	}

	/**
	 * Creates a new Resource.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @param $type
	 */
	public function actionAdd($type){
		
		if ($type == 'employee'){
 			$model = new Employees;
		}
		else if ($type == 'hardware'){
			$model = new Hardware;
		}
		else if ($type == 'facilities'){
			$model = new Facilities;
		}
		if (isset($_POST['Employees']) || isset($_POST['Hardware']) || isset($_POST['Facilities'])){
			if (get_class($model) == Employees) {
				$model->attributes = $_POST['Employees'];
				$model->e_type = Resources::getResourceIdByName($_POST['Employees']['e_type'], Resources::EMPLOYMENT_TYPES_DB);
			}
			else if (get_class($model) == Hardware) {
				$model->attributes = $_POST['Hardware'];
				$model->h_type = Resources::getResourceIdByName($_POST['Hardware']['h_type'], Resources::HARDWARE_TYPES_DB);
			}
			else if (get_class($model) == Facilities) {
				$model->attributes = $_POST['Facilities'];
				$model->f_type = Resources::getResourceIdByName($_POST['Facilities']['f_type'], Resources::FACILITY_TYPES_DB);
			}
			
			if($model->save()){
				$this->redirect(array('/resources'));

			}
		}
		else{
			$this->render('createResource',array(
				'model'=>$model,
			));
		}
	}
	
	/**
	 * Updates a particular Resource-model.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be updated
	 * @param string $type the Resourcetype of the model
	 */
	public function actionUpdateResource($id, $type){
		$model=$this->loadModel($type, $id);
		
		$this->performAjaxValidation($model);

		if(isset($_POST['Employees']) || isset($_POST['Hardware']) || isset($_POST['Facilities']))
		{
			$model->attributes=$_POST[$type];
			if($model->save())
				$this->redirect(array('/resources'));
		}

		$this->render('createResource',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 * @param string $type the Resourcetype of the model
	 */
	public function actionDeleteResource($id, $type){
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($type, $id)->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(array('/resources'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='resources-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function getResourceDataProvider($table, $id){

		if($id == null){
			$dataProvider = new CActiveDataProvider($table);			
		}
		else{
			$criteria = new CDbCriteria;
			$criteria->addCondition("pid = ".$id);

			$dataProvider = new CActiveDataProvider($table, array(
													'criteria'=>$criteria,
			));
		}
		return $dataProvider;
	}

	public function actionAddResources($type){
		$model = new AddResourceTypes;
		if(isset($_POST['AddResourceTypes'])){
			$model->storeToDb($_POST['AddResourceTypes'], $type);
			$this->redirect(array('/resources'));
		}
		else{
			$this->render('resourceType/add',array(
			'model'=>$model,
		));
		}
	}
	
	public function actionDeleteResources($resourceType){
		$model = new AddResourceTypes();
		
		if(isset($_POST['AddResourceTypes'])){
			$type =  $_POST['AddResourceTypes']['type'];
			if($resourceType == 'employment') $db = Resources::EMPLOYMENT_TYPES_DB;
			else if ($resourceType == 'hardware') $db = Resources::HARDWARE_TYPES_DB;
			else if ($resourceType == 'facilities') $db = Resources::FACILITY_TYPES_DB;
			$sql = 'DELETE from '.$db.' where type = \''.$type.'\'';
			
			Yii::app()->db->createCommand($sql)->execute();
				$this->redirect(array('/resources'));
			
		}
		else{
			$this->render('resourceType/delete', array(
				'model'=>$model,
			));
		}
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($type, $id)
	{
		if($type == 'Employees'){
			$model=Employees::model()->findByPk($id);
		}
		elseif ($type == 'Hardware') {
			$model = Hardware::model()->findByPk($id);
		}
		elseif ($type == 'Facilities') {
			$model = Facilities::model()->findByPk($id);
		}
		elseif ($type == 'CustomResources') {
			$model = CustomResources::model()->findByPk($id);
		}
		if($model===null){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}
	

}
