<?php
/* @var $this AssetController */
/* @var $model Asset */

$this->breadcrumbs=array(
	'Assets'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Asset', 'url'=>array('create')),
	array('label'=>'View Asset', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Asset', 'url'=>array('admin')),
);
?>

<h1>Update Asset </h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>