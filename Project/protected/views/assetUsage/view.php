<?php
/* @var $this AssetUsageController */
/* @var $model AssetUsage */

$this->breadcrumbs=array(
	'Asset Usages'=>array('index'),
);

$this->menu=array(
	array('label'=>'Create AssetUsage', 'url'=>array('create')),
	array('label'=>'Update AssetUsage', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete AssetUsage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AssetUsage', 'url'=>array('admin')),
        array('label'=>'Add End Date', 'url'=>array('assetUsage/enddate', 'id'=>$model->id)),

);
?>

<h1>View AssetUsage</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
                    'name'=>'Asset',
                    'value'=>$model->asset->asset_type,
                   ),
                    array(
                        'name'=>'Employee',
                        'value'=>$model->employee->name,
                    ),
                    'start_date',
                    'end_date',
                    array(
                        'name'=>'is_taken_out_of_office',
                        'filter'=>array(1=>'Yes',0=>'No'),
                        'value' => $model->is_taken_out_of_office ? "Yes" : "No",
                    ),
                    array(
                        'name'=>'Location',
                        'value' => $model->location->name,
                    ),
	),
)); ?>
