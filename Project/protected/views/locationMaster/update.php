<?php
/* @var $this LocationMasterController */
/* @var $model LocationMaster */

$this->breadcrumbs=array(
	'Location Masters'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create LocationMaster', 'url'=>array('create')),
	array('label'=>'View LocationMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LocationMaster', 'url'=>array('admin')),
);
?>

<h1>Update Location</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>