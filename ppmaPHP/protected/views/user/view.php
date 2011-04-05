<?php
$this->breadcrumbs=array(
	'Users'=>array('list'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('user')),
	array('label'=>'Update User', 'url'=>array('user/update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('user/delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this user?')),
);
?>

<h1>User <?php echo ($model->firstname.' '.$model->name )?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'firstname',
		'name',
	),
)); ?>