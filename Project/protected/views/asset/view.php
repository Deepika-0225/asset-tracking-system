<?php
/* @var $this AssetController */
/* @var $model Asset */

$this->breadcrumbs=array(
	'Assets'=>array('index'),
);

$this->menu=array(
	array('label'=>'Create Asset', 'url'=>array('create')),
	array('label'=>'Update Asset', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Asset', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Asset', 'url'=>array('admin')),
);
?>

<h1>View Asset </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                'asset_type',
                array(
                    'name' => 'asset_type_id',
                    'label' => 'Asset Type',
                    'value' => $model->assetType->types,
                ),
		'serial_number1',
		'serial_number2',
                'status',
	),
)); ?>
