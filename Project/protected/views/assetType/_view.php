<?php
/* @var $this AssetTypeController */
/* @var $data AssetType */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('types')); ?>:</b>
	<?php echo CHtml::encode($data->types); ?>
	<br />


</div>