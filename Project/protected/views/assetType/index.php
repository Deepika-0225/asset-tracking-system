<?php
/* @var $this AssetTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Asset Types',
);

$this->menu=array(
	array('label'=>'Create AssetType', 'url'=>array('create')),
	array('label'=>'Manage AssetType', 'url'=>array('admin')),
);
?>

<h1>Asset Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
