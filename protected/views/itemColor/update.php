<?php
$this->breadcrumbs=array(
	Yii::t('app','Item Color')=>array('admin'),
	'Update',
);

?>

<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
	'title' => Yii::t('app', 'Update Item Color'),
	'headerIcon' => 'ace-icon fa fa-adjust',
	'htmlHeaderOptions' => array('class' => 'widget-header-flat widget-header-small'),
	'content' => $this->renderPartial('_form', array('model' => $model), true),
)); ?>

<?php $this->endWidget(); ?>
