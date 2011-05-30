<?php
$this->breadcrumbs=array(
	'Milestones',
);

$this->menu=array(
	array('label'=>'Create Milestones', 'url'=>array('create')),
	array('label'=>'Manage Milestones', 'url'=>array('admin')),
);
?>

<h1>Milestones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
