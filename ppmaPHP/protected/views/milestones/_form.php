<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'milestones-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
				<?
$this->widget('application.extensions.jui.EDatePicker',
	              array(
                    'name'=>'start_date',
	              	'attribute'=>'start_date',
	              	'model'=>$model,
                    'language'=>'no',
                    'mode'=>'focus',
                    'dateFormat'=>'yy-m-d',
	             	'value'=>date('Y-m-d'),
                    'fontSize'=>'0.8em',
                    'htmlOptions'=>array('size'=>20,'class'=>'date'),
                   )
             );
?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?
$this->widget('application.extensions.jui.EDatePicker',
	              array(
                    'name'=>'end_date',
	              	'attribute'=>'end_date',
	              	'model'=>$model,
                    'language'=>'no',
                    'mode'=>'focus',
                    'dateFormat'=>'yy-m-d',
	             	'value'=>date('Y-m-d'),
                    'fontSize'=>'0.8em',
                    'htmlOptions'=>array('size'=>20,'class'=>'date'),
                   )
             );
?>
		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropdownList($model,'status', Project::encodeProperty('milestones_statuses')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->