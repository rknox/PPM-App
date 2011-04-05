<?php


class Resources
{

	const EMPLOYEE_DB = 'lf_employees';
	const HARDWARE_DB = 'lf_hardware';
	const FACILITY_DB = 'lf_facilities';
	const CUSTOM_RESOURCES_DB = 'lf_custom_resources';
	const EMPLOYMENT_TYPES_DB = 'lf_employment_types';
	const HARDWARE_TYPES_DB = 'lf_hardware_types';
	const FACILITY_TYPES_DB = 'lf_facility_types';
	const EMPLOYEE_SCHEDULE_DB = 'lf_employees_schedule';
	const HARDWARE_SCHEDULE_DB = 'lf_hardware_schedule';
	const FACILITY_SCHEDULE_DB = 'lf_facilities_schedule';

	public static function getResourceTypes($type){
		switch($type){
			case Resources::EMPLOYEE_DB:
				$sql = 'SELECT DISTINCT type FROM '.$type.' JOIN '.Resources::EMPLOYMENT_TYPES_DB;
				break;
					
			case Resources::HARDWARE_DB:
				$sql = 'SELECT DISTINCT type FROM '.$type.' JOIN '.Resources::HARDWARE_TYPES_DB;
				break;

			case Resources::FACILITY_DB:
				$sql = 'SELECT DISTINCT type FROM '.$type.' JOIN '.Resources::FACILITY_TYPES_DB;
				break;
			default:
				$error = Yii::app()->clientScript;
				$error->registerScript('error', 'alert("Invalid Query");', CClientScript::POS_READY);
		}
		$query = Yii::app()->db->createCommand($sql);

		return $query->queryColumn();
	}

	public static function getResourceNames($type){
		$sql = 'SELECT name FROM '.$type;
		return Yii::app()->db->createCommand($sql)->queryColumn();
	}

	public static function getResourceIdByName($name, $db){
		$sql = 'SELECT id FROM '.$db.' where type = \''.$name.'\'';
		$data =  Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0][0];

	}

public static function encodeResourcesForDDList($db){
		$counter = 1;
		$sql = "SELECT type FROM ".$db;
		$dataReader = Yii::app()->db->createCommand($sql)->query();

		foreach($dataReader as $row => $value) {
			foreach ($value as $key => $status){
				$array[$status] =  $status;
			}
		}
		return $array;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public static function loadModelByPid($type, $id)
	{
		if($type == 'Employees'){
			$model=EmployeeSchedule::model()->findAllByAttributes(array('pid'=>$id));
		}
		elseif ($type == 'Hardware') {
			$model = HardwareSchedule::model()->findAllByAttributes(array('pid'=>$id));
		}
		elseif ($type == 'Facilities') {
			$model = FacilitySchedule::model()->findAllByAttributes(array('pid'=>$id));
		}
		elseif ($type == 'CustomResources'){
			$model = CustomResources::model()->findAllByAttributes(array('pid'=>$id));
		}
		return $model;
	}
	
	public static function deleteResourceSchedule($type, $id){
		$resource = Resources::loadModelByPid($type, $id);
		if ($resource != null){
			foreach ($resource as $res){
				$res->delete();
			}
		}
	}
}