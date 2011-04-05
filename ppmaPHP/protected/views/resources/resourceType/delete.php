<?php
$this->menu=array(
	array('label'=>'Go Back To Resources', 'url'=>array('/resources')),
);
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Type to delete: '); ?>
		<?php echo $form->textField($model,'type',array('size'=>45,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'type'); ?>
		<?php echo $form->hiddenfield($model, 'hours', array('value'=>0))?>
	</div>

<br />
<div class="row buttons">
		<?php echo CHtml::submitButton('Delete', array('resourceType'=>$_GET['resourceType'])); ?>
</div>
</div>
<?php $this->endWidget(); ?>