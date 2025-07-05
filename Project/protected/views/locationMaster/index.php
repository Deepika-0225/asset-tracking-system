<?php
/* @var $this LocationMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Location Masters',
);

$this->menu=array(
	array('label'=>'Create LocationMaster', 'url'=>array('create')),
);
?>

<h1>Location Masters</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'locationMaster-grid',
	'dataProvider'=>$model->search(),
        'filter'=>$model,
	'columns'=>array(
		'name',
                    array(
                            'class'=>'CButtonColumn',
                            'template'=>'{view}{update}',
                    ),
            ),
)); ?>