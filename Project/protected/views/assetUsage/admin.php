<?php
/* @var $this AssetUsageController */
/* @var $model AssetUsage */

$this->breadcrumbs=array(
	'Asset Usages'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create AssetUsage', 'url'=>array('create')),
        array('label'=>'AssetUsage Report' , 'url'=>array('daterange')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#asset-usage-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Asset Usage</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'asset-usage-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                    'name' => 'asset_id',
                    'header' => 'Asset',
                    'value' => '$data->asset->asset_type',
                    'filter'=>CHtml::listData(Asset::model()->findAll(), 'id', 'asset_type'),
                ),

                array(
                    'name' => 'employee_id',
                    'header' => 'Employee',
                    'value' => '$data->employee->name',
                    'filter'=>CHtml::listData(Employee::model()->findAll(), 'id', 'name'),
                ),
            
                array(
                    'name' => 'location_id',
                    'header' => 'Location',
                    'value' => '$data->location->name',
                    'filter' => CHtml::listData(LocationMaster::model()->findAll(), 'id', 'name'),
                ),

                'start_date',
		'end_date',
                array(
                    'name'=>'is_taken_out_of_office',
                    'filter'=>array(1=>'Yes',0=>'No'),
                    'value'=>'$data->is_taken_out_of_office ? "Yes" : "No"',
                ),

                    array(
                            'class'=>'CButtonColumn',
                            'template'=>'{view}{update}',
//                            'buttons'=>array(
//                                'enddate'=>array(
//                                    'label'=>'Set End Date',
//                                    'url'=>'Yii::app()->createUrl("assetUsage/enddate", array("id"=>$data->id))',
//                                ),
//                            ),
                    ),
            ),
)); ?>
