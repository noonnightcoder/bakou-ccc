<?php
/* @var $this ColorCodeController */
/* @var $model ColorCode */
?>

<?php
$this->breadcrumbs=array(
	'Color Codes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ColorCode', 'url'=>array('index')),
	array('label'=>'Create ColorCode', 'url'=>array('create')),
	array('label'=>'View ColorCode', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ColorCode', 'url'=>array('admin')),
);
?>

    <h1>Update ColorCode <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>