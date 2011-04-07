<?php
class User extends CActiveRecord{
	
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	
	public function tableName()
	{
		return ("user");
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
			array('email, password', 'required'),
			array('email', 'email'),
			array('email, firstname, name, password', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, name, password', 'safe', 'on'=>'search'),
		);
	}
	
	public function hasAccsess($groupnames){
		foreach ($groupnames as $groupname){
			$group = Group::model()->findByAttributes(array('name'=>$groupname));
			if($this->gid&$group->id)
				return true;
		}
		return false;
	}
	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'firstname' => 'Firstname',
			'name' => 'Name',
			'password' => 'Password',
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getName($id){
		$sql = 'SELECT name FROM user WHERE id = '.$id;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data[0];
	}
	

}