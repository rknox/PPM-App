<?php

/**
 * This is the model class for table "milestones".
 *
 * The followings are the available columns in table 'milestones':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 * @property integer $status
 * @property integer $pid
 *
 * The followings are the available model relations:
 * @property MilestonesStatuses $status0
 * @property Projects2milestones[] $projects2milestones
 */
class Milestones extends CActiveRecord
{
	public $statusTable = 'milestones_statuses'; 
	/**
	 * Returns the static model of the specified AR class.
	 * @return Milestones the static model class
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
		return 'milestones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, status', 'required'),
			array('status, pid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>25),
			array('start_date, end_date, pid', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'status0' => array(self::BELONGS_TO, 'MilestonesStatuses', 'status'),
			'projects2milestones' => array(self::HAS_MANY, 'Projects2milestones', 'mid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'status' => 'Status',
			'pid' => 'Pid',
		);
	}
	
	public function getStatusText(){
		$projectStatus = Project::encodeProperty($this->statusTable);
		return(isset($projectStatus[$this->status]) ? $projectStatus[$this->status] : "unknown status ({$this->status})");
	}
	
	public static function checkForDeadlines(){
		$today = date("Y-m-d");
		$tomorrow = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+3, date("y")));
		$sql = "SELECT p.id as pid, p.name as project, m.id as mid, m.name as milestone, m.end_date as end_date FROM projects p join milestones m on p.id = m.pid where m.end_date >= '".$today."' AND m.end_date <= '".$tomorrow."'";
		$sqlQuery = Yii::app()->db->createCommand($sql);
		$data = $sqlQuery->queryAll();
		return $data;
	}
}