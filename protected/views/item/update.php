<?php
$this->breadcrumbs=array(
    Yii::t('app','Item')=>array('admin'),
    Yii::t('app','Update'),
);

?>


<?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
    'title' => Yii::t('app', 'Update Item'),
    'headerIcon' => 'ace-icon fa fa-qrcode',
    'htmlHeaderOptions' => array('class' => 'widget-header-flat widget-header-small'),
    'content' => $this->renderPartial('_form', array('model' => $model, 'validation_class' => $validation_class), true),
)); ?>

<?php $this->endWidget(); ?>