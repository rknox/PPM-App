<?php
class ListAction extends CAction
{

	public function run()
	{

		$controller = $this->controller;
		$milestones = Milestones::checkForDeadlines();
		$projects = Project::checkForDeadlines();
		if(count($milestones)!= 0){
			$s = '<div style="padding: 5px;background-color: #ffcccc; border: 3px solid red;margin-bottom: 10px;">';
			$s .= ' <b>Deadline is comming up for:</b><br /> ';
			foreach ($milestones as $row ) {
				$p = array();
				$i = 0;
				foreach ($row as $key => $value) {
					$p[$i] = $value;
					$i++;
				}
				$s .= 'Projekt: <a href ="project/'.$p[0].'">'.$p[1].'</a> Milestone: <a href="milestones/view/id/'.$p[2].'">'.$p[3].'</a><br />';
			}
			$s .= '</div>';
			Yii::app()->user->setFlash('deadline-milestone', $s );
		}
	if(count($projects)!= 0){
			$s = '<div style="padding: 5px;background-color: #ffcccc; border: 3px solid red;margin-bottom: 10px;">';
			$s .= ' <b>Deadline is comming up for:</b><br /> ';
			foreach ($projects as $row ) {
				$p = array();
				$i = 0;
				foreach ($row as $key => $value) {
					$p[$i] = $value;
					$i++;
				}
				$s .= 'Projekt: <a href ="project/'.$p[0].'">'.$p[1].'</a> ends on: '.$p[2].'<br />';
			}
			$s .= '</div>';
			Yii::app()->user->setFlash('deadline-project', $s );
		}

		$dataProvider=new CActiveDataProvider('Project');
		$controller->render('project/list',array(
			'dataProvider'=>$dataProvider,
		));
	}

} 