<?php
/* @var $this AssetTypeController */
/* @var $model AssetType */

$this->breadcrumbs=array(
	'Asset Types'=>array('index'),
	$model->types,
);

$this->menu=array(
	array('label'=>'Create AssetType', 'url'=>array('create')),
	array('label'=>'Update AssetType', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete AssetType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AssetType', 'url'=>array('admin')),
);
?>

<h1>View AssetType </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'types',
	),
)); ?>
