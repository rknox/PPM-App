<?php

/**
 * This is the model class for table "lf_employees".
 *
 * The followings are the available columns in table 'lf_employees':
 * @property integer $id
 * @property string $first_name
 * @property string $name
 * @property integer $e_type
 *
 * The followings are the available model relations:
 * @property LfEmploymentTypes $employee
 * @property LfEmployeesSchedule[] $lfEmployeesSchedules
 */
class Employees extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lf_employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('first_name, name, e_type', 'required'),
		array('e_type', 'numerical', 'integerOnly'=>true),
		array('first_name, name', 'length', 'max'=>50),
		array('name', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'employee' => array(self::BELONGS_TO, 'lf_Employment_types', 'e_type'),
			'schedule' => array(self::HAS_MANY, 'EmployeeSchedule', 'employee_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'name' => 'Name',
			'e_type' => 'Employmenee Type',
		);
	}
	
	public static function getEmployeeType($id){
		
		$sql = 'SELECT type from lf_employment_types where id = '.$id;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0];
	}
	

	
}