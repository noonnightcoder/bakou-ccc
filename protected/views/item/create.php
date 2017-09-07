<?php
$this->breadcrumbs=array(
    Yii::t('app','Item')=>array('admin'),
	Yii::t('app','Create'),
);

?>

<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message .
        '<button class="close" data-dismiss="alert" type="button">
                    <i class="ace-icon fa fa-times"></i>
                </button>' .
        "</div>\n";
}
?>

<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
    'title' => Yii::t('app', 'Create Item'),
    'headerIcon' => 'ace-icon fa fa-qrcode',
    'htmlHeaderOptions' => array('class' => 'widget-header-flat widget-header-small'),
    'content' => $this->renderPartial('_form', array('model' => $model, 'validation_class' => $validation_class), true),
)); ?>

<?php $this->endWidget(); ?>
