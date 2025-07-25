<?php /* @var $this Controller */ ?>
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

        <?php 
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile(
                Yii::app()->clientScript->getCoreScriptUrl() . '/jquery.yiiactiveform.js'
            );
        ?>


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu" >

		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
//				array('label' => 'Home', 'url' => array('/site/index')),
//                              array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
//                              array('label' => 'Contact', 'url' => array('/site/contact')),
                                array('label' => 'Register', 'url' => array('/site/register'), 'visible' => Yii::app()->user->isGuest),
				array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                //array('label'=>'Deepika', 'url'=>array('/site/deepika')),
                            
                            // Show these only to logged-in admins
                                array('label' => 'Employee', 'url' => array('/employee/admin'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'Asset Types', 'url' => array('/assetType/admin'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'Assets', 'url' => array('/asset/admin'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'Location', 'url' => array('/locationMaster/admin'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'Asset Usage', 'url' => array('/assetUsage/admin'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'Logout', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),                                                    
			),
		)); ?>
          
            
        </div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

<!--	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Deepika Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div> footer -->

</div><!-- page -->



</body>
</html>
