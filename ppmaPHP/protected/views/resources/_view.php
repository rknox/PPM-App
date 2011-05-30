<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->name), array('resources/view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_type')); ?>:</b>
	<?php echo CHtml::encode($data->e_type); ?>
	<br />
</div>