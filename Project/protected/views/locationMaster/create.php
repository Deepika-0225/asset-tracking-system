<?php
/* @var $this LocationMasterController */
/* @var $model LocationMaster */

$this->breadcrumbs=array(
	'Location'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Location', 'url'=>array('admin')),
);
?>

<h1>Create Location</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>