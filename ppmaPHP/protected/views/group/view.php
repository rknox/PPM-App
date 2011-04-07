<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Group', 'url'=>array('group/list')),
	array('label'=>'Create Group', 'url'=>array('group/create')),
	array('label'=>'Update Group', 'url'=>array('group/update', 'id'=>$model->id)),
	array('label'=>'Delete Group', 'url'=>'#', 'linkOptions'=>array('submit'=>array('group/delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Group', 'url'=>array('admin')),
);
?>

<h1>View Group <?php echo $model->name; ?></h1>

<?php 
	
	if(isset($_POST['del_uid'])){
		$model->deleteMember($model->id, $_POST['del_uid']);
	}
	else if(isset($_POST['add_uid'])){
		$model->addMember($model->id, $_POST['add_uid']);
	}
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
	),)); 
	
	
	$members = $model->getMembers($model->id);
	
	$members = $members[0];
	
	$dataProvider=new CArrayDataProvider($members);
	
	echo('<br/><h2>Members</h2>');
	$this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider' => $dataProvider,
	    'columns' => array(
	    'firstname', 
	    'name',
			array(
				'type'=>'raw',
				'value'=>'CHtml::submitButton("Delete", array("submit" => array("group/deleteMember/id/'. $model->id .'/uid/$data[id]")))',
			),
		),
	));
	echo('<br/><h2>add Member</h2>');
	$users = User::model()->findAll();
	$names = array();
	
	foreach ($users as $user){
		$tr = true;
		foreach ($members as $d){
			if($user->id==$d['id']){
				$tr=false;
			}
		}
		if($tr){
			$names[$user->id]=$user->firstname . ' ' . $user->name;
		}
	}
	echo CHtml::beginForm();
	echo CHtml::dropDownList('add_uid', $select, $names);
    echo CHtml::submitButton('add', array('submit' => array('group/view/id/'. $model->id,)));
    echo CHtml::endForm();
	?>
