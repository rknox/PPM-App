<?php

/**
 * This is the model class for table "lf_facilities".
 *
 * The followings are the available columns in table 'lf_facilities':
 * @property integer $id
 * @property string $name
 * @property integer $type
 *
 * The followings are the available model relations:
 * @property LfFacilitiesSchedule[] $lfFacilitiesSchedules
 */
class Facilities extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Facilities the static model class
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
		return 'lf_facilities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('name', 'safe'),
			array('f_type', 'required'),
			array('f_type', 'length', 'max'=>50),
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
			'lfFacilitiesSchedules' => array(self::HAS_MANY, 'LfFacilitiesSchedule', 'facility_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'f_type' => 'Type',
			'name' => 'Name',
		);
	}
	

}