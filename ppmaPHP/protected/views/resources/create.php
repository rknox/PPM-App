<?php
$this->breadcrumbs=array(
	'Resources'=>array('index'),
	'Create',
);

?>

<h1>Create Resources</h1>

<div class="form">
<form id="resource-form" method="post" action="#">
<h3>Staff</h3>
<?php
$counter = 0;
//Employee 1st Row
for($counter; $counter < 3; $counter++){
$this->widget('CAutoComplete', array(
			'model'=>$employees,
			'attribute'=>'Employee[name]',
			'data'=>$employeeNames,
			'multiple'=>false,
			'htmlOptions'=>array('size'=>25),
			'name'=>'Employee'.$counter.'[name]',
	)
);
$this->widget('application.extensions.jui.EDatePicker',
array(
			'name'=>'Employee'.$counter.'[start_date]',
			'attribute'=>'Employee[start_date]',
			'model'=>$employee,
			'language'=>'no',
			'mode'=>'focus',
			'dateFormat'=>'yy-m-d',
	       	'value'=>'',
            'fontSize'=>'0.8em',
            'htmlOptions'=>array('size'=>8,'class'=>'date', 'readonly'=>'true'),
	)
);
$this->widget('application.extensions.jui.EDatePicker',
array(
			'name'=>'Employee'.$counter.'[end_date]',
			'attribute'=>'Employee[end_date]',
			'model'=>$employee,
			'language'=>'no',
			'mode'=>'focus',
			'dateFormat'=>'yy-m-d',
			'value'=>'',
			'fontSize'=>'0.8em',
			'htmlOptions'=>array('size'=>8,'class'=>'date', 'readonly'=>'true'),
	)
);
echo '<br />';
}

?>
<h3>Hardware</h3>
<?php
$counter = 0;
foreach ($hardware as $key => $value) {
	$formString = '<div class="row"><label class="required" for="hardware_type">';
	$formString .= $value;
	$formString .= ' <span class="required">*</span></label>';
	$formString .= '<input type="text" name="Hardware'.$counter.'[name]" style="display:none" value="'.$value.'"/>';
	echo $formString;
	$this->widget('application.extensions.jui.EDatePicker',
	array(
                    'name'=>'Hardware'.$counter.'[start_date]',
	              	'attribute'=>'Hardware[start_date]',
	              	'model'=>$hardware,
                    'language'=>'no',
                    'mode'=>'focus',
                    'dateFormat'=>'yy-m-d',
	             	'value'=>'',
                    'fontSize'=>'0.8em',
                    'htmlOptions'=>array('size'=>8,'class'=>'date', 'readonly'=>'true'),
					'id'=>$value.'-start',
	)
	);
	$this->widget('application.extensions.jui.EDatePicker',
	array(
                    'name'=>'Hardware'.$counter.'[end_date]',
	              	'attribute'=>'Hardware[end_date]'.$counter,
	              	'model'=>$hardware,
                    'language'=>'no',
                    'mode'=>'focus',
                    'dateFormat'=>'yy-m-d',
	             	'value'=>'',
                    'fontSize'=>'0.8em',
                    'htmlOptions'=>array('size'=>8,'class'=>'date', 'readonly'=>'true'),
					'id'=>$value.'-end',
	)
	);
	echo '</div>';
	$counter++;
}
?>
<h3>Räumlichkeiten</h3>
<?php
$counter = 0;
foreach ($facilities as $key => $value) {
	$formString = '<div class="row"><label class="required" for="hardware_type">';
	$formString .= $value;
	$formString .= ' <span class="required">*</span></label>';
	$formString .= '<input type="text" value="'.$value.'" name="Facilities'.$counter.'[name]" style="display:none" />';
	echo $formString;
	$this->widget('application.extensions.jui.EDatePicker',
	array(
                    'name'=>'Facilities'.$counter.'[start_date]',
	              	'attribute'=>'Facilities[start_date]',
	              	'model'=>$facilities,
                    'language'=>'no',
                    'mode'=>'focus',
                    'dateFormat'=>'yy-m-d',
	             	'value'=>'',
                    'fontSize'=>'0.8em',
                    'htmlOptions'=>array('size'=>8,'class'=>'date', 'readonly'=>'true'),
					'id'=>$value.'-start',
	)
	);
	$this->widget('application.extensions.jui.EDatePicker',
	array(
                    'name'=>'Facilities'.$counter.'[end_date]',
	              	'attribute'=>'Facilities[end_date]',
	              	'model'=>$facilities,
                    'language'=>'no',
                    'mode'=>'focus',
                    'dateFormat'=>'yy-m-d',
	             	'value'=>'',
                    'fontSize'=>'0.8em',
                    'htmlOptions'=>array('size'=>8,'class'=>'date', 'readonly'=>'true'),
					'id'=>$value.'-end',
	)
	);

	echo '</div>';
	$counter++;
}
?>
<h3>Custom Resources</h3>
<?php
$counter = 0;
for($i = 0; $i < 3; $i++) {
	$formString = '<div class="row">';
	$formString .= '<input type="text" name="CustomResources'.$i.'[name]" />';
	echo $formString;
	$this->widget('application.extensions.jui.EDatePicker',
	array(
                    'name'=>'CustomResources'.$counter.'[start_date]',
	              //	'attribute'=>'[start_date]',
	              	'model'=>$customResources,
                    'language'=>'no',
                    'mode'=>'focus',
                    'dateFormat'=>'yy-m-d',
	             	'value'=>'',
                    'fontSize'=>'0.8em',
                    'htmlOptions'=>array('size'=>8,'class'=>'date', 'readonly'=>'true'),
	)
	);
	$this->widget('application.extensions.jui.EDatePicker',
	array(
                    'name'=>'CustomResources'.$counter.'[end_date]',
	              	//'attribute'=>'[end_date]',
	              	'model'=>$customResources,
                    'language'=>'no',
                    'mode'=>'focus',
                    'dateFormat'=>'yy-m-d',
	             	'value'=>'',
                    'fontSize'=>'0.8em',
                    'htmlOptions'=>array('size'=>8,'class'=>'date', 'readonly'=>'true'),
	)
	);
	echo '</div>';
	$counter++;
}
?>
<div class="row buttons"><?php echo CHtml::submitButton('Save', array('name'=>'create')); ?></div>
</form>
</div>
