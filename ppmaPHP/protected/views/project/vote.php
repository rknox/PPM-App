<?php
$this->pageTitle = Yii::app()->name.'Vote';

$this->menu=array(
	array('label'=>'Back to Project', 'url'=>array('project/view', 'id'=>$model->project->id)),
);
?>

<h1>Vote for <?php echo $model->project->name; ?></h1>
<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
		<?php echo $form->radioButtonList($model, 'vote', array('0'=>'Yes', '1'=>'No'), array('separator'=>'')); ?>
</div>
<br />
<div class="row buttons">
		<?php echo CHtml::submitButton('Vote'); ?>
</div>
<?php $this->endWidget(); ?>