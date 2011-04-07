<?php
class Action extends CAction{
	
	public $con;
	
	public function run(){}
	
	public function Action()
	{
		$this->con = $this->controller;	
	}
	
}