<?php
$this->breadcrumbs=array(
	'Projects',
	'list',
);

$this->menu=array(
	array('label'=>'Create Project', 'url'=>array('project/create')),
);
?>


<?php if(Yii::app()->user->hasFlash('alert-deadline')):?>
	<div class="alert">
		<?php echo Yii::app()->user->getFlash('alert-deadline'); ?>
	</div>
<?php endif; ?>


<h1>Projects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'project/_view',
)); ?>
