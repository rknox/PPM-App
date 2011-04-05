<?php
$this->breadcrumbs=array(
	'Resources'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
$this->menu=array(
	array('label'=>'Add Resources', 'url'=>array('resources/create', 'pid'=>$_GET['id'])),
);
?>

<h1>Update Resources <?php echo $model->project->name; ?></h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>
<h3>Staff</h3>

<?php
$counter = 0;
foreach($employee as $emp){

	echo '<div class="row"><label for="name">';
	echo EmployeeSchedule::getResourceName($emp->employee_id, Resources::EMPLOYEE_DB);
	echo '<input type="hidden" id="EmployeeSchedule'.$counter.'[id]" value="'.$emp->id.'" name="EmployeeSchedule'.$counter.'[id]" /><br />';
	echo '</label>';
	echo'</div>';
	echo '<div class="row">';
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
	echo '<input type="checkbox" name="EmployeeSchedule'.$counter.'[delete]" value="delete" />delete';
	echo '</div>';
	echo '<br />';
	$counter++;

}
?>
<h3>Hardware</h3>
<?php 

$counter = 0;
foreach($hardware as $hard){

	echo '<div class="row"><label for="name">';
	echo HardwareSchedule::getResourceName($hard->hardware_id).'<br />';
	echo '<input type="hidden" id="HardwareSchedule'.$counter.'[id]" value="'.$hard->id.'" name="HardwareSchedule'.$counter.'[id]" /><br />';
	echo '</label>';
	echo'</div>';
	echo '<div class="row">';

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
	echo '<input type="checkbox" name="HardwareSchedule'.$counter.'[delete]" value="delete" />delete';
	echo '</div>';
	$counter++;

}
?>
<h3>Facilities</h3>
<?php
$counter = 0;
foreach($facility as $fac){

	echo '<div class="row"><label for="name">';
	echo FacilitySchedule::getResourceName($fac->facility_id).'<br />';
	echo '<input type="hidden" id="FacilitiesSchedule'.$counter.'[id]" value="'.$fac->id.'" name="FacilitiesSchedule'.$counter.'[id]" /><br />';	
	echo '</label>';
	echo'</div>';
	echo '<div class="row">';
	
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
	echo '<input type="checkbox" name="FacilitiesSchedule'.$counter.'[delete]" value="delete" />delete(Klappt nicht bei mehreren?)';
	echo '</div>';
	$counter++;
}
?>
<h3>Custom Resources</h3>
<?php
$counter = 0;
foreach($customResources as $cus){

	echo '<div class="row"><label for="name">';
	echo $cus->name;
	echo '<input type="hidden" id="CustomResources'.$counter.'[id]" value="'.$cus->id.'" name="CustomResources'.$counter.'[id]" /><br />';	
	echo '</label>';
	echo'</div>';
	echo '<div class="row">';

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
	echo '<input type="checkbox" name="CustomResources'.$counter.'[delete]" value="delete" />delete(Klappt nicht bei mehreren?)';
	echo '</div>';
	$counter++;
}
?>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
