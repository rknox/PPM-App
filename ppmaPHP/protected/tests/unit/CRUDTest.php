<?php 
class CRUDTest extends CTestCase{
	public function testCRUD(){
		
		//CREATE Test
		$newProject = new Project();
		$projectName = 'This is a Test';
		$newProject->setAttributes(
			array(
						'name'=>$projectName,
						'description'=>'This project is for test purpose only',
						'start_date'=>'2010-11-15 15:00:00',
						'end_date'=>'2010-12-06 00:00:00',
						'update_user_id'=>1,
						'category'=>2,
						'status'=>1,
						'owner'=>1,
			)
		);
		
		$this->assertTrue($newProject->save(false));
		
		
		//READ Test
		$readProject = Project::model()->findByPk($newProject->id);
		$this->assertTrue($readProject instanceof Project);
		$this->assertEquals($projectName, $readProject->name);
		
		//UPDATE Test
		$updateProjectName = 'Updated Name2';
		$newProject->name = $updateProjectName;
		$this->AssertTrue($newProject->save(false));
		
		$updatedProject = Project::model()->findByPk($newProject->id);
		$this->assertTrue($updatedProject instanceof Project);
		$this->assertNotEquals($projectName, $updatedProject->name);
		
		//DELETE Test
		$deletedProjectId = $newProject->id;
		$newProject->delete();
		$deletedProject = Project::model()->findByPk($newProject->id);
		$this->assertEquals(Null, $deletedProject);
		
		//GetUserVote Test
		$project = Project::model()->findByPk(18);
		$this->assertTrue($project->getUserVote(7)==true);
		
		//Vote Test
		$this->assertTrue($project->vote(1, 1)==1);
		
		
	}
}