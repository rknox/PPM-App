<?php
$this->breadcrumbs=array(
	'Resources'=>array('index'),
	'Create',
);

?>

<h1>Create Resources</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
