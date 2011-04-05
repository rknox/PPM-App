<?php
/**
 * This is the model class for table "lf_facilities_schedule".
 *
 * The followings are the available columns in table 'lf_facilities_schedule':
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property integer $pid
 * @property integer $facility_id
 */
class FacilitySchedule extends CActiveRecord{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lf_facilities_schedule';
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
			'projectObject' => array(self::MANY_MANY, 'Project', 'pid'),
			'resource' => array(self::HAS_ONE, 'Facilities', 'id'),
		);
	}

	public static function getResourceId($name, $db){
		$sql = 'SELECT '.Resources::FACILITY_TYPES_DB.'.id from '.$db.' JOIN '.Resources::FACILITY_TYPES_DB.' where type = "'.$name.'"';
		$query = Yii::app()->db->createCommand($sql);
		$data =  $query->queryColumn();
		return $data[0][0];
	}
	
	public static function getResourceName($id){
		$sql = 'SELECT name from '.Resources::FACILITY_DB.' WHERE id = '.$id;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0];
	}

	public static function getresourceType($id){
		$sql = 'SELECT type FROM '.Resources::FACILITY_DB.' f LEFT JOIN '.Resources::FACILITY_TYPES_DB.' t on f.f_type = t.id where f.id = '.$id;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0];
	}
	public static function findAvailableFacilityResource($resourceDb, $start, $end, $name){
		//CHECK WETHER THERE IS A RESOURCE OF TYPE $type LEFT (COUNT $booked AGAINST $available???
		// NEEDED:
		//  -NR. OF RESOURCES OF TYPE $type
		//  -NR OF RESOUCRES LEFT AFTER SUBTRACTING $booked
		//  -ASSIGN A RESOURCE_ID IF POSSIBLE
		$fid = 0;
		$id = Resources::getResourceIdByName($name, $resourceDb);
		$numberOfResources = FacilitySchedule::getNrOfAvailableResources($id);
		$reservedResources = FacilitySchedule::getNrOfReservedFacilityResources($start, $end, $id);
		if(($numberOfResources - $reservedResources) > 0){
			$fid = FacilitySchedule::getBookableFacilityResources($start, $end, $id);
		}
		else{
			$error = Yii::app()->clientScript;
			$error->registerScript('error', 'alert("No resource '.$name.' Available!");', CClientScript::POS_READY);
		}
		return $fid;
	}
	
	public function getNrOfAvailableResources($id){
		$sql = 'SELECT count(*) from '.Resources::FACILITY_DB.' WHERE f_type = '.$id;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		
		return $data[0][0];
	}

	public function getNrOfReservedFacilityResources($start, $end, $resourceId){
		$sql = 'SELECT count(*) FROM '.Resources::FACILITY_DB.' f ';
		$sql .= 'JOIN '.Resources::FACILITY_TYPES_DB.' t ON f.f_type = t.id ';
		$sql .= ' JOIN '.Resources::FACILITY_SCHEDULE_DB.' s ON s.facility_id = f.id';
		$sql .= ' WHERE ((start_date BETWEEN  \''.$start.'\' AND \''.$end.'\')';
		$sql .= ' OR (end_date BETWEEN \''.$start.'\' AND \''.$end.'\'))';
		$sql .= ' AND f_type = '.$resourceId;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0];
	}

	public function getBookableFacilityResources($start, $end, $resourceId){
		$sql = '';
		$stm = 'SELECT facility_id from '.Resources::FACILITY_SCHEDULE_DB.'  WHERE facility_id = '.$resourceId.' LIMIT 1';
		$inTable = Yii::app()->db->createCommand($stm)->querycolumn();
		$nonScheduledResources = FacilitySchedule::getNonScheduledResources();
		//if ($inTable == null && $nonScheduledResources ){
		if ($nonScheduledResources == 0){
//			$sql = 'SELECT f.id FROM '.Resources::FACILITY_DB.' f LEFT JOIN '.Resources::FACILITY_TYPES_DB.' t ON f.f_type = t.id WHERE t.id = '.$resourceId.' LIMIT 1';			
//		}
//		else {
			$sql = 'SELECT f_type FROM '.Resources::FACILITY_DB.' f ';
			$sql .= 'JOIN '.Resources::FACILITY_TYPES_DB.' t ON f.f_type = t.id';
			$sql .= ' JOIN '.Resources::FACILITY_SCHEDULE_DB.' s ON s.facility_id = f.id';
			$sql .= ' WHERE (start_date NOT BETWEEN  \''.$start.'\' AND \''.$end.'\')';
			$sql .= ' OR (end_date NOT BETWEEN \''.$start.'\' AND \''.$end.'\')';
			$sql .= ' AND f_type = '.$resourceId;
			$data = Yii::app()->db->createCommand($sql)->queryColumn();
			$nonScheduledResources = $data[0][0];
		}
		
		return $nonScheduledResources;
	}
	
	public static function getNonScheduledResources(){
		$sql = 'SELECT id FROM '.Resources::FACILITY_DB.' where id not IN (SELECT DISTINCT facility_id FROM '.Resources::FACILITY_SCHEDULE_DB.') LIMIT 1';
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0][0];
	}
}