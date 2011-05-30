<?php
$this->breadcrumbs=array(
	'Projects'=>array('project'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('project')),
	array('label'=>'Create Project', 'url'=>array('project/create')),
	array('label'=>'Update Project', 'url'=>array('project/update', 'id'=>$model->id)),
	array('label'=>'Delete Project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('project/delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'[Take out in final Version] Vote', 'url'=>array('project/vote', 'id'=>$model->id)),
	array('label'=>'View Resources', 'url'=>array('resources/view', 'id'=>$model->id)),
	array('label'=>'Manage Members', 'url'=>array('project/'.$model->id.'/manageMembers')),
);
if(!Project::hasUserVoted(Yii::app()->user->id, $model->id)){
	$this->menu[] = array('label'=>'Vote for Project', 'url'=>array('project/vote', 'id'=>$model->id));
}

?>

<h1><?php echo $model->name; ?></h1>

<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'owner',
			'value'=>CHtml::encode($model->ownerObj->firstname . ' ' .$model->ownerObj->name) 
		),
		'description',
		'start_date',
		'end_date',
		'budget',
		array(
			'name'=>'category',
			'value'=>CHtml::encode($model->getCategoryText())
		),
		array(
			'name'=>'status',
			'value'=>CHtml::encode($model->getStatusText())
		),

	),
)); 
echo '<br />';

echo '<b>Members</b><br />';

if(isset($_POST['add_gid'])){
	if(count($_POST['add_type'])>0)
		$model->addGroup($model->id, $_POST['add_gid'], $_POST['add_type']);
}

$members = Project::model()->getGroups($model->id);
$members = $members[0];

$dataProvider=new CArrayDataProvider($members);

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'name',
		array(
			'type'=>'raw',
			'value'=>'CHtml::dropDownList("listname", $data[type], 
              array("0" => "read", "1" => "write"))'
		),
		array(
			'type'=>'raw',
			'value'=>'CHtml::submitButton("Delete", array("submit" => array("project/deleteGroup/id/'. $model->id .'/gid/$data[id]")))',
		),
	),
));

echo('<br/><h2>add Group</h2>');
	$groups = Group::model()->findAll();
	$names = array();
	
	foreach ($groups as $group){
		$tr = true;
		foreach ($members as $d){
			if($group->id==$d['id']){
				$tr=false;
			}
		}
		if($tr){
			$names[$group->id]=$group->name;
		}
	}
	
	echo CHtml::beginForm();
	echo CHtml::dropDownList('add_gid', $select, $names);
	echo '<br />';
	
	$sql = "SELECT * FROM rights";
	$sqlQuery = Yii::app()->db->createCommand($sql);
		
	$tempRes[] = $sqlQuery->queryAll();
		
	$rightsarr;
	foreach ($tempRes[0] as $right){
		$rightsarr[$right['id']]=$right['name'];
	}
	
	echo CHtml::checkBoxList('add_type', $select, $rightsarr);
	echo '<br />';
    echo CHtml::submitButton('add', array('submit' => array('project/view/id/'. $model->id,)));
    echo CHtml::endForm();

echo "<br />";

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
		'name'=>'Vote Result',
		'type'=>'raw',
		'value'=>'CHtml::encode($data["voteOption"])'
		),
		array(
		'name'=>'',
		'type'=>'raw',
		'value'=>'CHtml::encode($data["voteResult"])'
		),
	),
));


?>
