<?php
/* @var $this AssetUsageController */
/* @var $model AssetUsage */

$this->breadcrumbs=array(
	'Asset Usages'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage AssetUsage', 'url'=>array('admin')),
);
?>

<h1>Create AssetUsage</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>