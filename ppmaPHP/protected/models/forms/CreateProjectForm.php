<?php

/**
 * CreateProjectForm class
 * Creates a new project
 */

class CreateProjectForm extends CFormModel{
	
	public $id;
	public $name;
	public $description;
	public $status;
	public $startDate;
	public $endDate;
	public $resources;
	public $owner;
	
	public function rules(){
		return array(
			array('name, description, startDate, endDate, resources', 'required'),
		);	
	}
	
}