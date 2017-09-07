<?php
$this->breadcrumbs=array(
	Yii::t('app','Item Size') => array('admin'),
	'Create',
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
	'title' => Yii::t('app', 'Create Item Size'),
	'headerIcon' => 'ace-icon fa fa-list',
	'htmlHeaderOptions' => array('class' => 'widget-header-flat widget-header-small'),
	'content' => $this->renderPartial('_form', array('model' => $model), true),
)); ?>

<?php $this->endWidget(); ?>

