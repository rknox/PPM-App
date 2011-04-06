<?php
$this->breadcrumbs=array(
	'Milestones'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Milestones', 'url'=>array('index')),
	array('label'=>'Create Milestones', 'url'=>array('create')),
	array('label'=>'Update Milestones', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Milestones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Milestones', 'url'=>array('admin')),
);
?>

<h1>View Milestones #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'start_date',
		'end_date',
		array(
			'name'=>'Status',
			'value'=>CHtml::encode($model->getStatusText()),
		),
		'description',
	),
)); ?>
