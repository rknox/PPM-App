<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('user/list')),
	array('label'=>'Manage User', 'url'=>array('user/admin')),
);
?>

<h1>Create User</h1>

<?php echo $this->renderPartial('user/_form', array('model'=>$model)); ?>