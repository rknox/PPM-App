<?php 


$this->breadcrumbs=array(
	'Projects',
	'list',
);

$this->menu=array(
	array('label'=>'View Project', 'url'=>array('project/view/'.$_GET['id'])),
);

?>
<h1><?php echo $model->name; ?></h1>
<table>
<?php 

	$members = Project::model()->getGroups($model->id);
	$members = $members[0];
	
	foreach ($members as $member) {
		?>
			<tr>
				<td>
		<?php
		echo $member['name'] .' '.$member->name; 
		?>
				</td>
				<td>
					<?php echo '<a href="manageMembers/delete/'.$member->id.'">delete</a>'?>
				</td>
			</tr>
		<?php 
	}

?>
</table>
