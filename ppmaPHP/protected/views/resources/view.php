<?php


$this->menu=array(
	array('label'=>'Go Back To Project', 'url'=>array('project/view', 'id'=>$model->pid)),
	array('label'=>'Edit Resources', 'url'=>array('resources/update', 'id'=>$_GET['id'])),
);
?>

<h1>View Resources <?php echo ''; ?></h1>
<h3>Staff</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
   	'dataProvider'=>$employee,
	'columns'=>array(
		array(
			'name'=>'resource.last_name',
			'value'=>'EmployeeSchedule::getResourceName($data->employee_id, Resources::EMPLOYEE_DB)',
			),
	'start_date',
	'end_date',
)
));
													
 ?>
<br />
<h3>Hardware</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
   	 	'dataProvider'=>$hardware,
		'columns'=>array(
		array(
			'name'=>'Type',
			'value'=>'HardwareSchedule::getResourceType($data->hardware_id)',
			),
		array(
			'name'=>'Hardware',
			'value'=>'HardwareSchedule::getResourceName($data->hardware_id)',
			),
	'start_date',
	'end_date',
			)
));
 ?>
<br />
<h3>R&auml;mlichkeiten</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
   	 	'dataProvider'=>$facility,
		'columns'=>array(
		array(
			'name'=>'Facility',
			'value'=>'FacilitySchedule::getResourceType($data->facility_id)',
		),
		array(
			'name'=>'Name',
			'value'=>'FacilitySchedule::getResourceName($data->facility_id)',
		),
		'start_date',
		'end_date',
			),
));
 ?>
<br />
<h3>Custom Resources</h3>
<?php $this->widget('zii.widgets.grid.CGridView',array(
		'dataProvider'=>$customResources,
		'columns'=>array(
			'name',
			'start_date',
			'end_date',
			array(
				'name'=>'Owner',
				'value'=>'User::getName($data->owner)',
			)
		)

));
	
?>
