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
				array('description', 'required'),
				array('name', 'safe', 'on'=>'search'),
			);
		}
		
		public function attributeLabels()
		{
			return array(
				'name' => 'Name',
				'description' => 'Description',
			);
		}
		
		public function getMembers($gid){
			$sql = "SELECT user.id, user.name, user.firstname FROM user, user2group, groups 
			WHERE user2group.gid = :gid
			AND  user.id = user2group.uid
			GROUP BY user.id";
			$sqlQuery = Yii::app()->db->createCommand($sql);
			$sqlQuery->bindValue(":gid", $gid, PDO::PARAM_INT);
			
			$tempRes[] = $sqlQuery->queryAll();
			return $tempRes;
			
		}
		
		public function deleteMember($gid, $mid){
			$sql = "DELETE FROM user2group WHERE uid = :mid AND gid = :gid";
			$sqlQuery = Yii::app()->db->createCommand($sql);
			$sqlQuery->bindValue(":gid", $gid, PDO::PARAM_INT);
			$sqlQuery->bindValue(":mid", $mid, PDO::PARAM_INT);
			
			$tempRes[] = $sqlQuery->execute();
		}
		
		public function addMember($gid, $mid){
			$sql = "INSERT INTO user2group VALUES($mid , $gid )";
			$sqlQuery = Yii::app()->db->createCommand($sql);
			
			$tempRes[] = $sqlQuery->execute();
		}
		
		public function search()
			{
		
				$criteria=new CDbCriteria;
				$criteria->compare('name',$this->name,true);
				$criteria->compare('description',$this->description,true);
		
				return new CActiveDataProvider(get_class($this), array(
					'criteria'=>$criteria,
				));
			}
}