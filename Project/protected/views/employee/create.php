<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Employee', 'url'=>array('index')),
);
?>

<h1>Create Employee</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>