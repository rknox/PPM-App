<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('project/list')),
);
?>

<h1>Create Project</h1>

<?php echo $this->renderPartial('project/_form', array('model'=>$model)); ?>
