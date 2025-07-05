<?php
/* @var $this AssetTypeController */
/* @var $model AssetType */

$this->breadcrumbs=array(
	'Asset Types'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create AssetType', 'url'=>array('create')),
	array('label'=>'View AssetType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AssetType', 'url'=>array('admin')),
);
?>

<h1>Update AssetType </h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>