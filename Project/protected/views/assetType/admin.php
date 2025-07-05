<?php
/* @var $this AssetTypeController */
/* @var $model AssetType */

$this->breadcrumbs=array(
	'Asset Types'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create AssetType', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#asset-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Asset Types</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'asset-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'types',
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{view} {update}',
		),
	),
)); ?>
