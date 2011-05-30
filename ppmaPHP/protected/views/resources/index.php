<?php


$this->menu=array(
	array('label'=>'Go Back To Project', 'url'=>array('project/view', 'id'=>$model->pid)),
	array('label'=>'Add', 'url'=>array('resources/update', 'id'=>$_GET['id'])),
);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>

<h1>Administer Resources</h1>
<h3>Staff</h3>
<?php echo CHtml::link('add Employee', array('/resources/add', 'type'=>'employee'))?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
   	'dataProvider'=>$employees,
	'columns'=>array(
		array(
			'name'=>'resource.last_name',
			'value'=>'EmployeeSchedule::getResourceName($data->id, Resources::EMPLOYEE_DB)',
			),
		array(
			'name'=>'e_type',
			'value'=>'Employees::getEmployeeType($data->e_type)',
			),
			array(
			'type'=>'raw',
			'name'=>'Update',
			'value'=>'CHtml::link("Update","#",array("submit"=>array("resources/updateResource","type"=>"Employees", "id"=>$data->id)))',
			),
		array(
			'type'=>'raw',
			'name'=>'Delete',
			'value'=>'CHtml::link("Delete","#",array("submit"=>array("resources/deleteResource","type"=>"Employees", "id"=>$data->id),"confirm"=>"are you sure?"))',
			),
	)
));													
 ?>
<br />
<h3>Hardware</h3>
<?php echo CHtml::link('add Hardware', array('/resources/add', 'type'=>'hardware'))?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
   	 	'dataProvider'=>$hardware,
		'columns'=>array(
		array(
			'name'=>'Hardware',
			'value'=>'HardwareSchedule::getResourceName($data->id)',
			),
		array(
			'name'=>'Type',
			'value'=>'HardwareSchedule::getResourceType($data->id)',
			),
			array(
			'type'=>'raw',
			'name'=>'Update',
			'value'=>'CHtml::link("Update","#",array("submit"=>array("resources/updateResource","type"=>"Hardware", "id"=>$data->id)))',
			),
		array(
			'type'=>'raw',
			'name'=>'Delete',
			'value'=>'CHtml::link("Delete","#",array("submit"=>array("resources/deleteResource","type"=>"Hardware", "id"=>$data->id),"confirm"=>"are you sure?"))',
			),
		)
));
 ?>
<br />
<h3>Facilities</h3>
<?php echo CHtml::link('add Facility', array('/resources/add', 'type'=>'facilities'))?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
   	 	'dataProvider'=>$facilities,
		'columns'=>array(
		array(
			'name'=>'Facility',
			'value'=>'FacilitySchedule::getResourceType($data->id)',
		),
		array(
			'name'=>'Name',
			'value'=>'FacilitySchedule::getResourceName($data->id)',
		),
			array(
			'type'=>'raw',
			'name'=>'Update',
			'value'=>'CHtml::link("Update","#",array("submit"=>array("resources/updateResource","type"=>"Facilities", "id"=>$data->id)))',
			),
		array(
			'type'=>'raw',
			'name'=>'Delete',
			'value'=>'CHtml::link("Delete","#",array("submit"=>array("resources/deleteResource","type"=>"Facilities", "id"=>$data->id),"confirm"=>"are you sure?"))',
			),
	)
));
 ?>
<?php $this->endWidget(); ?>

