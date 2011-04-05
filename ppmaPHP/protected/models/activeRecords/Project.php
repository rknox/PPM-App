<?php

/**
 * This is the model class for table "projects".
 *
 * The followings are the available columns in table 'projects':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 * @property string $update_time
 * @property integer $update_user_id
 * @property integer $category
 * @property string $status
 * @property string $owner
 * @property integer $budget
 *
 * The followings are the available model relations:
 */
class Project extends CActiveRecord
{
	public $categoryTable = 'categories';
	public $statusTable  = 'statuses';
	public $memberTable = 'projectMember';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Project the static model class
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
		return 'projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('name, description, category, status', 'required'),
		array('name', 'unique'),
		array('category, budget', 'numerical', 'integerOnly'=>true),
		array('name', 'length', 'max'=>50),
		array('start_date, end_date, update_time, update_user_id', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'ownerObj'=>array(self::BELONGS_TO, 'User', 'owner'),
			'members'=>array(self::MANY_MANY, 'User', 
                    'projectMember(pid, uid)')
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
			'description' => 'Description',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
			'category' => 'Category',
			'status' => 'Status',
			'owner' => 'Owner',
			'budget' => 'Budget',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('category',$this->category);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('owner',$this->owner,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function encodeProperty($property){
		$counter = 1;
		$connection=Yii::app()->db;
		$sql = "SELECT name FROM ".$property;
		$sqlQuery = $connection->createCommand($sql);
		$dataReader = $sqlQuery->query();

		foreach($dataReader as $row => $value) {
			foreach ($value as $key => $status){
				$array[$counter] =  $status;
				$counter++;
			}
		}
		return $array;
	}
	public function getStatusText(){
		$projectStatus = $this->encodeProperty($this->statusTable);
		return(isset($projectStatus[$this->status]) ? $projectStatus[$this->status] : "unknown status ({$this->status})");
	}
	
	public function getCategoryText(){
		$projectCategory = $this->encodeProperty($this->categoryTable);
		return(isset($projectCategory[$this->category]) ? $projectCategory[$this->category] : "unknown category ({$this->category}.");
	}
	
	protected function beforeValidate(){
		$this->update_time = new CDbExpression('NOW()');
		$this->update_user_id = Yii::app()->user->id;

		if($this->isNewRecord){
			$this->owner = Yii::app()->user->id;
		}
		return parent::beforeValidate();
	}
	
	public function vote($vote, $uid){
		$sql = "INSERT INTO votings VALUES(:pid, :uid, :vote)";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":pid", $this->id, PDO::PARAM_INT);
		$command->bindValue(":uid", $uid, PDO::PARAM_INT);
		$command->bindValue(":vote", $vote, PDO::PARAM_INT);
		return $command->execute();
	}
	
	public static function hasUserVoted($userId, $pid){
		$sql = "SELECT vote from votings where uid = :uid and pid = :projectId";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":uid", $userId, PDO::PARAM_INT);
		$command->bindValue(":projectId", $pid, PDO::PARAM_INT);
		return $command->execute()==1 ? true : false;
	}
	
	public static function getVoteResultsPerOption($pid, $option){

		$sql = "SELECT count(*) from votings where pid = :pid AND vote = :vote";
		$sqlQuery = Yii::app()->db->createCommand($sql);
		$sqlQuery->bindValue(":pid", $pid, PDO::PARAM_INT);
		$sqlQuery->bindValue(":vote", $option, PDO::PARAM_INT);
		
		$vote[] = $sqlQuery->queryColumn();
		return $vote[0][0];
	}
	
	public static function isOwner($pid, $uid){
		$project = Project::model()->findByPk($pid);
		if($uid == $project->owner){
			return true;
		}
		return false;
	}
	
	public static function getMember($pid){
		$sql = 'SELECT uid FROM projectMember where pid = '.$pid;
		$data = Yii::app()->db->createCommand($sql)->queryColumn();
		return $data;
	}
	
}