<?php
$this->breadcrumbs=array(
	'Projects',
	'list',
);

$this->menu=array(
	array('label'=>'Create Project', 'url'=>array('project/create')),
);
?>

<h1>Projects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'project/_view',
)); ?>
