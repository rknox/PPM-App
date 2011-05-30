<?php
$this->menu=array(
	array('label'=>'Go Back To Resources', 'url'=>array('/resources')),
);
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm'); ?>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>45,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php
			if ($_GET['type'] == 'employment'){
				echo $form->labelEx($model,'hours'); 
				echo $form->textField($model,'hours',array('size'=>45,'maxlength'=>50)); 
				echo $form->error($model,'type');
			}
			else 	
				echo $form->hiddenfield($model, 'hours', array('value'=>0))?>
	</div>
<br />
<div class="row buttons">
		<?php echo CHtml::submitButton('Create'); ?>
</div>
</div>
<?php $this->endWidget(); ?>