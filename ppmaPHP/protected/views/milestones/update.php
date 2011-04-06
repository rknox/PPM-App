<?php
$this->breadcrumbs=array(
	'Milestones'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Milestones', 'url'=>array('index')),
	array('label'=>'Create Milestones', 'url'=>array('create')),
	array('label'=>'View Milestones', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Milestones', 'url'=>array('admin')),
);
?>

<h1>Update Milestones <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>