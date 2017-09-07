<?php
/* @var $this ColorCodeController */
/* @var $model ColorCode */
?>

<?php
$this->breadcrumbs=array(
	'Color Codes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ColorCode', 'url'=>array('index')),
	array('label'=>'Create ColorCode', 'url'=>array('create')),
	array('label'=>'Update ColorCode', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ColorCode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ColorCode', 'url'=>array('admin')),
);
?>

<h1>View ColorCode #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'barcode_number',
		'no',
		'size',
		'col',
		'qual',
	),
)); ?>