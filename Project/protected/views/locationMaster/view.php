<?php
/* @var $this LocationMasterController */
/* @var $model LocationMaster */

$this->breadcrumbs=array(
	'Location Masters'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List LocationMaster', 'url'=>array('index')),
	array('label'=>'Create Location', 'url'=>array('create')),
	array('label'=>'Update Location', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete LocationMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Location', 'url'=>array('admin')),
);
?>

<h1>View Location </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
	),
)); ?>
