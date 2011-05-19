<?php
class ListAction extends CAction
{

	public function run()
	{

		$controller = $this->controller;
		$data = Project::checkForDeadlines();

		if(count($data)!= 0){
			$s = '<div style="padding: 5px;background-color: #ffcccc; border: 3px solid red;margin-bottom: 10px;">';
			$s .= ' <b>Deadline is comming up for:</b><br /> ';
			foreach ($data as $row ) {
				$p = array();
				$i = 0;
				foreach ($row as $key => $value) {
					$p[$i] = $value;
					$i++;
				}
				$s .= 'Projekt: <a href ="project/'.$p[0].'">'.$p[1].'</a> Milestone: <a href="milestones/view/id/'.$p[2].'">'.$p[3].'</a><br />';
			}
			$s .= '</div>';
			Yii::app()->user->setFlash('alert-deadline', $s );
		}

		$dataProvider=new CActiveDataProvider('Project');
		$controller->render('project/list',array(
			'dataProvider'=>$dataProvider,
		));
	}

}