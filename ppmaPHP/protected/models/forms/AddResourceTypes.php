<?php

class AddResourceTypes extends CFormModel{
	
	public $type;
	public $hours;
	
	public function attributeLabels()
	{
		return array(
			'type' => 'Type',	
			'hours' => 'Hours / week',		
		);
	}
	
		/**
		 * @return array validation rules for model attributes.
		 */
		public function rules()
		{
			return array(
				array('type', 'required'),
				array('hours', 'safe'),
			);
		}
	
	public function storeToDb($entry, $type){
		if ($type == 'hardware') {
			$db = Resources::HARDWARE_TYPES_DB;
		}
		else if($type == 'facilities') {
			$db = Resources::FACILITY_TYPES_DB;
		}
			$sql = 'Insert into '.$db.' (type) values (\''.$entry['type'].'\')';
			
		if ($type == 'employment') {
			$db = Resources::EMPLOYMENT_TYPES_DB;
			$sql = 'Insert into '.Resources::EMPLOYMENT_TYPES_DB.' (type, hours_per_week) values (\''.$entry['type'].'\',\''.$entry['hours'].'\')'; 
		}
			Yii::app()->db->createCommand($sql)->execute();
	}
}


