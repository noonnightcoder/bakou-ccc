<?php
/* @var $this ItemSizeController */
/* @var $model ItemSize */
?>

<?php
$this->breadcrumbs=array(
	'Item Sizes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ItemSize', 'url'=>array('index')),
	array('label'=>'Create ItemSize', 'url'=>array('create')),
	array('label'=>'Update ItemSize', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ItemSize', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ItemSize', 'url'=>array('admin')),
);
?>

<h1>View ItemSize #<?php echo $model->id; ?></h1>

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