<?php
class DbTest extends CTestCase{
	public function testConnection(){
		$this->assertNotEquals(Null, Yii::app()->db);
	}
}