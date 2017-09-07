<?php
/* @var $this ColorCodeController */
/* @var $data ColorCode */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('barcode_number')); ?>:</b>
	<?php echo CHtml::encode($data->barcode_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no')); ?>:</b>
	<?php echo CHtml::encode($data->no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('size')); ?>:</b>
	<?php echo CHtml::encode($data->size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('col')); ?>:</b>
	<?php echo CHtml::encode($data->col); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qual')); ?>:</b>
	<?php echo CHtml::encode($data->qual); ?>
	<br />


</div>