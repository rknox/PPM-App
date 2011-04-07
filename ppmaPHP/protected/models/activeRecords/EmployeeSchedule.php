<?php
/**
 * This is the model class for table "lf_employees_Schedule".
 *
 * The followings are the available columns in table 'lf_employees_Schedule':
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property integer $pid
 * @property integer $employee_id
 *
 * The followings are the available model relations:
 * @property LfEmploymentTypes $project
 * @property EmployeesSchedule $resource
 */
class EmployeeSchedule extends CActiveRecord{

	/**
	 * Returns the static model of the specified AR class.
	 * @return Employees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('start_date, end_date', 'required'),
		array('id, employee_Id, pid', 'safe'),
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lf_employees_schedule';
	}



	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'project' => array(self::BELONGS_TO, 'Project', 'pid'),
			'resource' => array(self::BELONGS_TO, 'Employees', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'employee_id' => 'Name',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',

		);
	}

	public function getResourceId($name, $db){
		$sql = 'SELECT id from '.$db.' where name = "'.$name.'"';
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0][0];
	}

	public static function getResourceName($id, $db){
		$sql = 'SELECT name from '.$db.' where id = '.$id;
		$query = Yii::app()->db->createCommand($sql);
		$data = $query->queryColumn();
		return $data[0];
	}

	public static function findAvailableEmployeeResource($resourceDb, $start, $end, $name){
		//CHECK WETHER THERE IS A RESOURCE OF TYPE $type LEFT (COUNT $booked AGAINST $available???
		// NEEDED:
		//  - CHECK WETHER EMPLOYEE IS $booked FOR $date
		//  -ASSIGN RESOURCE_ID IF POSSIBLE
		$id = EmployeeSchedule::getResourceId($name, $resourceDb);

		if((EmployeeSchedule::isEmployeeBookable($start, $end, $id)) > 0){
			$id = 0;
			$error = Yii::app()->clientScript;
			$error->registerScript('error', 'alert("Employee '.$name.' is not available!");', CClientScript::POS_READY);
		}
		return $id;
	}
	
	public function isEmployeeBookable($start, $end, $resourceId){
		$sql = 'SELECT count(*) FROM '.Resources::EMPLOYEE_DB.' e LEFT JOIN '.Resources::EMPLOYEE_SCHEDULE_DB.' s ';
		$sql .= ' ON e.id = s.employee_id ';
		$sql .= 'WHERE e.id = '.$resourceId;
		$sql .= ' AND ((start_date BETWEEN  \''.$start.'\' AND \''.$end.'\')';
		$sql .= ' OR (end_date BETWEEN \''.$start.'\' AND \''.$end.'\'))';
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0][0];
	}
}