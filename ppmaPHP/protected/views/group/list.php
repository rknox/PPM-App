<?php
$this->breadcrumbs=array(
	'Group',
	'list',
);

$this->menu=array(
	array('label'=>'Create Group', 'url'=>array('group/create')),
);
?>

<h1>Projects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'group/_view',
)); ?>
