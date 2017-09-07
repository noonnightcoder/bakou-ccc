<?php
/* @var $this ItemColorController */
/* @var $model ItemColor */
?>

<?php
$this->breadcrumbs=array(
	'Item Colors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ItemColor', 'url'=>array('index')),
	array('label'=>'Create ItemColor', 'url'=>array('create')),
	array('label'=>'Update ItemColor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ItemColor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ItemColor', 'url'=>array('admin')),
);
?>

<h1>View ItemColor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'name',
		'full_name',
		'status',
		'create_at',
		'update_at',
		'create_by',
		'update_by',
	),
)); ?>