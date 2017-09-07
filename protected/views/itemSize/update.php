<?php
$this->breadcrumbs=array(
	Yii::t('app','Item Size')=>array('admin'),
	'Update',
);
?>

<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
	'title' => Yii::t('app', 'Update Item Size'),
	'headerIcon' => 'ace-icon fa fa-list',
	'htmlHeaderOptions' => array('class' => 'widget-header-flat widget-header-small'),
	'content' => $this->renderPartial('_form', array('model' => $model), true),
)); ?>

<?php $this->endWidget(); ?>
