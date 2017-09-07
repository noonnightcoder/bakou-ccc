<?php
/* @var $this ItemController */
/* @var $model Item */
?>

<?php
$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->name,
);

?>

<!--<h1>View Item #<?php /*echo $model->id; */?></h1>-->

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'barcode',
		'item_number',
		'size_id',
		'color_id',
		'name',
		'name_jp',
		'status',
		'create_at',
		'update_at',
		'create_by',
		'update_by',
	),
)); ?>