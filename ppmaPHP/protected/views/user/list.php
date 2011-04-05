<?php
$this->breadcrumbs=array(
	'Users',
	'list'
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('user/create')),
);
?>

<h1>Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'user/_view',
)); ?>
