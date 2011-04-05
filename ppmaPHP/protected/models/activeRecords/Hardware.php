<?php

/**
 * This is the model class for table "lf_hardware".
 *
 * The followings are the available columns in table 'lf_hardware':
 * @property integer $id
 * @property string $name
 * @property integer $h_type
 *
 * The followings are the available model relations:
 * @property LfHardwareTypes $hType0
 * @property LfHardwareSchedule[] $lfHardwareSchedules
 */
class Hardware extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Hardware the static model class
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
		return 'lf_hardware';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, h_type', 'required'),
			array('h_type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
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
			'hType0' => array(self::BELONGS_TO, 'LfHardwareTypes', 'h_type'),
			'lfHardwareSchedules' => array(self::HAS_MANY, 'LfHardwareSchedule', 'hardware_id'),
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
			'h_type' => 'Type',
		);
	}
}