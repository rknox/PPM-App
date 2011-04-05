<?php
$this->breadcrumbs=array(
	'Projects'=>array('project'),
	'Update',
	$model->name=>array('view','id'=>$model->id),
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('project/list')),
	array('label'=>'Create Project', 'url'=>array('project/create')),
	array('label'=>'View Project', 'url'=>array('project/view', 'id'=>$model->id)),
);
?>

<h1>Update <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('project/_form', array('model'=>$model)); ?>