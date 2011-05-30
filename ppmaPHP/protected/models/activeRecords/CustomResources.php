<?php

/**
 * This is the model class for table "lf_custom_resources".
 *
 * The followings are the available columns in table 'lf_custom_resources':
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $owner
 * @property string $pid
 *
 * The followings are the available model relations:
 * @property Projects $project
 * @property user $ownerReference
 */
class CustomResources extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CustomResources the static model class
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
		return 'lf_custom_resources';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start_date, end_date, owner, pid', 'required'),
			array('name', 'length', 'max'=>255),
			array('name', 'safe'),
			array('owner, pid', 'length', 'max'=>11),
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
			'project' => array(self::BELONGS_TO, 'Projects', 'id'),
			'ownerReference' => array(self::BELONGS_TO, 'User', 'id'),
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
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'owner' => 'Owner',
			'pid' => 'Pid',
		);
	}
}