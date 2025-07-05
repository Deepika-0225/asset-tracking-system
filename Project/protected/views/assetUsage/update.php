<?php
/* @var $this AssetUsageController */
/* @var $model AssetUsage */

$this->breadcrumbs=array(
	'Asset Usages'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create AssetUsage', 'url'=>array('create')),
	array('label'=>'View AssetUsage', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AssetUsage', 'url'=>array('admin')),
);
?>

<h1>Update AssetUsage</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>