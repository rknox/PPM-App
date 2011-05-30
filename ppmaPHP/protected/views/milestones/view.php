<?php
$this->breadcrumbs=array(

);

$this->menu=array(
	array('label'=>'Back to Project', 'url'=>array('project/view', 'id'=>$model->pid)),
	array('label'=>'Update Milestones', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Milestones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Milestone "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'start_date',
		'end_date',
		array(
			'name'=>'Status',
			'value'=>CHtml::encode($model->getStatusText()),
		),
		'description',
	),
)); ?>
