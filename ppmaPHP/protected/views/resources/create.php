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
		//	'attribute'=>'Employee[name]',
			'data'=>$employeeNames,
			'multiple'=>false,
			'htmlOptions'=>array('size'=>25),
			'name'=>'EmployeeSchedule'.$counter.'[name]',
	)
);
$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
   		'name'=>'EmployeeSchedule'.$counter.'[start_date]',
   		'model'=>$emp,
   		'value'=>$emp->start_date,
        'htmlOptions'=>array('size'=>18,'class'=>'date'),
    	'options'=>array(
    	    'hourGrid' => 4,
     	   'hourMin' => 8,
     	   'hourMax' => 18,
     	   'timeFormat' => 'h:m',
     	   'changeMonth' => true,
     	   'changeYear' => false,
			'dateFormat'=>'yy-mm-dd',
            'timeFormat' => 'hh:mm:ss',
    	   'showAnim'=>'fold',
   		    ),
   		 )
	 );
	echo '<b> to </b>';
		$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
   		'name'=>'EmployeeSchedule'.$counter.'[end_date]',
   		'model'=>$emp,
   		'value'=>$emp->start_date,
        'htmlOptions'=>array('size'=>18,'class'=>'date'),
    	'options'=>array(
    	    'hourGrid' => 4,
     	   'hourMin' => 9,
     	   'hourMax' => 18,
     	   'timeFormat' => 'h:m',
     	   'changeMonth' => true,	
			'changeYear' => false,
			'dateFormat'=>'yy-mm-dd',
            'timeFormat' => 'hh:mm:ss',
     		'showAnim'=>'fold',
    	    ),
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
	$formString .= '<input type="text" name="HardwareSchedule'.$counter.'[name]" style="display:none" value="'.$value.'"/>';
	echo $formString;
		$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
   		'name'=>'HardwareSchedule'.$counter.'[start_date]',
   		'model'=>$emp,
   		'value'=>$emp->start_date,
        'htmlOptions'=>array('size'=>18,'class'=>'date'),
    	'options'=>array(
    	    'hourGrid' => 4,
     	   'hourMin' => 8,
     	   'hourMax' => 18,
     	   'timeFormat' => 'h:m',
     	   'changeMonth' => true,
     	   'changeYear' => false,
			'dateFormat'=>'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
	
       'showAnim'=>'fold',

    	    ),
   		 )
   	 );
	echo '<b> to </b>';
		$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
   		'name'=>'HardwareSchedule'.$counter.'[end_date]',
   		'model'=>$emp,
   		'value'=>$emp->start_date,
        'htmlOptions'=>array('size'=>18,'class'=>'date'),
    	'options'=>array(
    	    'hourGrid' => 4,
     	   'hourMin' => 9,
     	   'hourMax' => 18,
     	   'timeFormat' => 'h:m',
     	   'changeMonth' => true,
     	   'changeYear' => false,
			'dateFormat'=>'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
	
       'showAnim'=>'fold',

    	    ),
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
	$formString .= '<input type="text" value="'.$value.'" name="FacilitiesSchedule'.$counter.'[name]" style="display:none" />';
	echo $formString;
	$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
   		  'name'=>'FacilitiesSchedule'.$counter.'[start_date]',
   		'model'=>$emp,
   		'value'=>$emp->start_date,
        'htmlOptions'=>array('size'=>18,'class'=>'date'),
    	'options'=>array(
    	    'hourGrid' => 4,
     	   'hourMin' => 8,
     	   'hourMax' => 18,
     	   'timeFormat' => 'h:m',
     	   'changeMonth' => true,
     	   'changeYear' => false,
			'dateFormat'=>'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
	
       'showAnim'=>'fold',

    	    ),
   		 )
   	 );

	$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
   		'name'=>'FacilitiesSchedule'.$counter.'[end_date]',
   		'model'=>$emp,
   		'value'=>$emp->start_date,
        'htmlOptions'=>array('size'=>18,'class'=>'date'),
    	'options'=>array(
    	    'hourGrid' => 4,
     	   'hourMin' => 9,
     	   'hourMax' => 18,
     	   'timeFormat' => 'h:m',
     	   'changeMonth' => true,
     	   'changeYear' => false,
			'dateFormat'=>'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
	
       'showAnim'=>'fold',

    	    ),
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
	$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
   		  'name'=>'CustomResources'.$counter.'[start_date]',
   		'model'=>$emp,
   		'value'=>$emp->start_date,
        'htmlOptions'=>array('size'=>18,'class'=>'date'),
    	'options'=>array(
    	    'hourGrid' => 4,
     	   'hourMin' => 8,
     	   'hourMax' => 18,
     	   'timeFormat' => 'h:m',
     	   'changeMonth' => true,
     	   'changeYear' => false,
			'dateFormat'=>'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
	
       'showAnim'=>'fold',

    	    ),
   		 )
   	 );

	$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
   		'name'=>'CustomResources'.$counter.'[end_date]',
   		'model'=>$emp,
   		'value'=>$emp->start_date,
        'htmlOptions'=>array('size'=>18,'class'=>'date'),
    	'options'=>array(
    	    'hourGrid' => 4,
     	   'hourMin' => 9,
     	   'hourMax' => 18,
     	   'timeFormat' => 'h:m',
     	   'changeMonth' => true,
     	   'changeYear' => false,
			'dateFormat'=>'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
	
       'showAnim'=>'fold',

    	    ),
   		 )
   	 );
	echo '</div>';
	$counter++;
}
?>
<div class="row buttons"><?php echo CHtml::submitButton('Save', array('name'=>'create')); ?></div>
</form>
</div>
