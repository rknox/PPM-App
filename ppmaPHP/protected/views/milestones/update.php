<?php
$this->breadcrumbs=array(
	'Milestones'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Back to Project', 'url'=>array('project/view', 'id'=>$model->pid)),
);
?>

<h1>Update Milestones <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>