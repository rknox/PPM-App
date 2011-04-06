<?php
$this->breadcrumbs=array(
	'Milestones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Back to Project', 'url'=>array('project/view', 'id'=>$model->pid)),
);
?>

<h1>Create Milestones</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>