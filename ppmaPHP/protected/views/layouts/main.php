<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php 
		$admin = '';
		if(!Yii::app()->user->isGuest)
			if(Yii::app()->user->object->hasAccsess(Array('admin')))
				$admin = ' (admin!)';
		echo CHtml::encode(Yii::app()->name.$admin); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php 
		$script = '';
		$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Projects', 'url'=>array($script.'/project'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'User', 'url'=>array($script.'/user'), 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->object->hasAccsess(Array('admin'))),
				array('label'=>'Group', 'url'=>array($script.'/group'), 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->object->hasAccsess(Array('admin'))),
				array('label'=>'Administer Resources', 'url'=>array('/resources')),
				array('label'=>'Logout', 'url'=>array($script.'/auth/logout'), 'visible'=>!Yii::app()->user->isGuest),			
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by lichtflut F&E GmbH.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>