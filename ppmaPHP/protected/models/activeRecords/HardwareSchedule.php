<?php
/**
 * This is the model class for table "lf_Hardware_Schedule".
 *
 * The followings are the available columns in table 'lf_Hardware_Schedule':
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property integer $pid
 * @property integer $hardware_id
 */
class HardwareSchedule extends CActiveRecord{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lf_hardware_schedule';
	}

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
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'project' => array(self::MANY_MANY, 'Project', 'pid'),
			'resource' => array(self::HAS_ONE, 'Lf_Hardware', 'hardware_id'),
		);
	}

	public static function getResourceId($name, $db){
		$sql = 'SELECT '.Resources::HARDWARE_TYPES_DB.'.id from '.$db.' JOIN '.Resources::HARDWARE_TYPES_DB.' where type = "'.$name.'"';
		$query = Yii::app()->db->createCommand($sql);
		$data =  $query->queryColumn();
		return $data[0][0];
	}

	public static function getResourceName($id){
		$sql = 'SELECT name from '.Resources::HARDWARE_DB.' WHERE id = '.$id;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0];
	}
	
	public static function getresourceType($id){
		$sql = 'SELECT type FROM '.Resources::HARDWARE_DB.' h LEFT JOIN '.Resources::HARDWARE_TYPES_DB.' t on h.h_type = t.id where h.id = '.$id;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0];
	}

	public function getNrOfAvailableResources($id){
		$sql = 'SELECT count(*) from '.Resources::HARDWARE_DB.' WHERE h_type = '.$id;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		
		return $data[0][0];
	}

	public static function findAvailableHardwareResource($resourceDb, $start, $end, $name){
		//CHECK WETHER THERE IS A RESOURCE OF TYPE $type LEFT (COUNT $booked AGAINST $available???
		// NEEDED:
		//  -NR. OF RESOURCES OF TYPE $type
		//  -NR OF RESOUCRES LEFT AFTER SUBTRACTING $booked
		//  -ASSIGN A RESOURCE_ID IF POSSIBLE
		$hid = 0;
		$id = Resources::getResourceIdByName($name, $resourceDb);
		$numberOfResources = HardwareSchedule::getNrOfAvailableResources($id);
		$reservedResources = HardwareSchedule::getNrOfReservedHardwareResources($start, $end, $id);
		if(($numberOfResources - $reservedResources) > 0){
			$hid = HardwareSchedule::getBookableHardwareResources($start, $end, $id);
		}
		else{
			$error = Yii::app()->clientScript;
			$error->registerScript('error', 'alert("No resource '.$name.' Available!");', CClientScript::POS_READY);
		}

		return $hid;
	}

	public function getNrOfReservedHardwareResources($start, $end, $resourceId){
		$sql = 'SELECT count(*) FROM '.Resources::HARDWARE_DB.' h ';
		$sql .= 'JOIN '.Resources::HARDWARE_TYPES_DB.' t ON h.h_type = t.id ';
		$sql .= ' JOIN '.Resources::HARDWARE_SCHEDULE_DB.' s ON s.hardware_id = h.id';
		$sql .= ' WHERE ((start_date BETWEEN  \''.$start.'\' AND \''.$end.'\')';
		$sql .= ' OR (end_date BETWEEN \''.$start.'\' AND \''.$end.'\'))';
		$sql .= ' AND h_type = '.$resourceId;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0][0];
	}

	public function getBookableHardwareResources($start, $end, $resourceId){
		$sql = '';
		$stm = 'SELECT hardware_id from lf_hardware_schedule  WHERE hardware_id = '.$resourceId.' LIMIT 1';
		$inTable = Yii::app()->db->createCommand($stm)->querycolumn();
		if ($inTable == null){
			$sql = 'SELECT h.id FROM '.Resources::HARDWARE_DB.' h LEFT JOIN '.Resources::HARDWARE_TYPES_DB.' t ON h.h_type = t.id WHERE t.id = '.$resourceId.' LIMIT 1';
		}
		else {
			$sql = 'SELECT h_type FROM '.Resources::HARDWARE_DB.' h ';
			$sql .= 'JOIN '.Resources::HARDWARE_TYPES_DB.' t ON h.h_type = t.id';
			$sql .= ' JOIN '.Resources::HARDWARE_SCHEDULE_DB.' s ON s.hardware_id = h.id';
			$sql .= ' WHERE (start_date NOT BETWEEN  \''.$start.'\' AND \''.$end.'\')';
			$sql .= ' OR (end_date NOT BETWEEN \''.$start.'\' AND \''.$end.'\')';
			$sql .= ' AND h_type = '.$resourceId;
		}
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0][0];
	}
}