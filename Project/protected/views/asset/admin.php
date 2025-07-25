<?php
/* @var $this AssetController */
/* @var $model Asset */

$this->breadcrumbs=array(
	'Assets'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Asset', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#asset-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Assets</h1>
<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div> search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'asset-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                
                array(
                    'name' => 'asset_type_id',
                    'header' => 'Asset Type',
                    'value' => '$data->assetType->types',
                    'filter' => CHtml::listData(AssetType::model()->findAll(), 'id', 'types'),
                ),
                'asset_type',
		'serial_number1',
		'serial_number2',
                'status',
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{view} {update}',
		),
	),
)); ?>
