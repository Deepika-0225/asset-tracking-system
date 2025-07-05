<?php
/* @var $this AssetController */
/* @var $data Asset */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serial_number1')); ?>:</b>
	<?php echo CHtml::encode($data->serial_number1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serial_number2')); ?>:</b>
	<?php echo CHtml::encode($data->serial_number2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asset_type')); ?>:</b>
	<?php echo CHtml::encode($data->asset_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asset_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->asset_type_id); ?>
	<br />


</div>