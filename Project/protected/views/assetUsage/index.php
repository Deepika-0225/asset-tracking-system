<?php
/* @var $this AssetUsageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Asset Usages',
);

$this->menu=array(
	array('label'=>'Create AssetUsage', 'url'=>array('create')),
	array('label'=>'Manage AssetUsage', 'url'=>array('admin')),
);
?>

<h1>Asset Usages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
