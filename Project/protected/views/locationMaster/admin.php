<?php
/* @var $this LocationMasterController */
/* @var $model LocationMaster */

$this->breadcrumbs=array(
	'Location'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Location', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#location-master-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Location</h1>
<!--
echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
$this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div> search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'location-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
			'class'=>'CButtonColumn',
                        'template'=>'{view} {update}',
		),
	),
)); ?>
