<?php
$this->breadcrumbs=array(
	'Projects'=>array('project'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('project')),
	array('label'=>'Update Project', 'url'=>array('project/update', 'id'=>$model->id)),
	array('label'=>'Delete Project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('project/delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'[Take out in final Version] Vote', 'url'=>array('project/vote', 'id'=>$model->id)),
	array('label'=>'View Resources', 'url'=>array('resources/view', 'id'=>$model->id)),
	array('label'=>'Manage Members', 'url'=>array('project/'.$model->id.'/manageMembers')),
	array('label'=>'Add Milestone', 'url'=>array('milestones/create', 'pid'=>$model->id))
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


foreach ($model->members as $member){
	echo '- ' .$member->firstname . ' ' . $member->name  . '<br />';
}

foreach ($model->milestones as $ms){
	echo '- ' .$ms->name.'<br />';
}

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$milestones,
	'columns'=>array(
		array(
			'type'=>'raw',
			'name'=>'Milestones',
			'value'=>'CHtml::link($data->name, array("/milestones/view", "id"=>$data->id))',
		),
		'start_date',
		'end_date',
		array(
			'name'=>'Status',
			'value'=>'CHtml::encode($data->getStatusText())',
		),
	)
));
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
