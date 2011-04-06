<?php
$this->breadcrumbs=array(
	'Milestones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Milestones', 'url'=>array('index')),
	array('label'=>'Manage Milestones', 'url'=>array('admin')),
);
?>

<h1>Create Milestones</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>