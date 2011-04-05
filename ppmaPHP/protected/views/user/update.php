<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('user/list')),
	array('label'=>'View User', 'url'=>array('user/view', 'id'=>$model->id)),

);
?>

<h1>Update User <?php echo $model->firstname.' '.$model->name; ?></h1>

<?php echo $this->renderPartial('user/_form', array('model'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'firstname',
		'name',
	),
	)); ?>