<?php
class Group extends CActiveRecord
{
	public static function model($className=__CLASS__)
	    {
	        return parent::model($className);
	    }
		
		public function tableName(){
			return ("groups");
		}
		
		public function getId(){
				return $id;
		}
		
		/**
		 * @return array validation rules for model attributes.
		 */
		public function rules()
		{
			return array(
				array('name', 'required'),
				array('id', 'required'),
				array('name', 'safe', 'on'=>'search'),
			);
		}
		
		public function attributeLabels()
		{
			return array(
				'name' => 'Name',
			);
		}
		
		public function search()
			{
		
				$criteria=new CDbCriteria;
				$criteria->compare('name',$this->name,true);
		
				return new CActiveDataProvider(get_class($this), array(
					'criteria'=>$criteria,
				));
			}
}