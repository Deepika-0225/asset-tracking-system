<?php
/* @var $this EmployeeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Employees',
);

$this->menu=array(
	array('label'=>'Create Employee', 'url'=>array('create')),
);
?>

<h1>Employees</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'employee-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'name',
        'email',
        array(
            'name'=>'is_active',
            'filter'=>array(1=>'Active',0=>'Inactive'),
            'value'=>'$data->is_active ? "Active" : "Inactive"',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}',
        ),
    ),
)); 

?>
