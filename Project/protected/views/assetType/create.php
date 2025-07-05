<?php
/* @var $this AssetTypeController */
/* @var $model AssetType */

$this->breadcrumbs=array(
	'Asset Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage AssetType', 'url'=>array('admin')),
);
?>

<h1>Create AssetType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>