<?php

if (get_class($model) == Hardware) {


$this->menu=array(
	array('label'=>'Add new Hardwaretype', 'url'=>array('/resources/addResources', 'type'=>'hardware')),
	array('label'=>'Delete Hardware Type', 'url'=>array('/resources/deleteResources', 'resourceType'=>'hardware')),
	array('label'=>'Go Back To Resources', 'url'=>array('/resources')),
);
}
else if (get_class($model) == Facilities) {
$this->menu=array(
	array('label'=>'Add new Facility', 'url'=>array('/resources/addResources', 'type'=>'facilities')),
	array('label'=>'Delete Facility Type', 'url'=>array('/resources/deleteResources', 'resourceType'=>'facilities')),
	array('label'=>'Go Back To Resources', 'url'=>array('/resources')),
);
}
else if (get_class($model) == Employees) {
$this->menu=array(
	array('label'=>'Add new Employment Type', 'url'=>array('/resources/addResources', 'type'=>'employment')),
	array('label'=>'Delete Employment Type', 'url'=>array('/resources/deleteResources', 'resourceType'=>'employment')),
	array('label'=>'Go Back To Resources', 'url'=>array('/resources')),
);
}
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'resource-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php 
		if (get_class($model) == Employees){
			echo '<div class="row">';
			echo $form->labelEx($model,'first_name'); 
			echo $form->textField($model,'first_name',array('size'=>45,'maxlength'=>50)); 
			echo $form->error($model,'first_name'); 
			echo '</div>';
		}
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<?php 

		if (get_class($model) == Employees){
			$dbLabelForType = 'e_type';
			$db = Resources::EMPLOYMENT_TYPES_DB;
		}
		else if (get_class($model) == Hardware) {
			$dbLabelForType = 'h_type';
			$db = Resources::HARDWARE_TYPES_DB;
		}
		else if (get_class($model) == Facilities) {
			$dbLabelForType = 'f_type';
			$db = Resources::FACILITY_TYPES_DB;
		};
	?>
	<div class="row">
		<?php echo $form->labelEx($model,$dbLabelForType); ?>
		<?php echo $form->dropDownList($model, $dbLabelForType, Resources::encodeResourcesForDDList($db), array('empty'=>'Please Select')) ?>
		<?php echo $form->error($model, $dbLabelForType); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Create'); ?>
	</div>
	
	<?php $this->endWidget(); ?>

</div><!-- form -->