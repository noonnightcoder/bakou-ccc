<?php
/* @var $this ItemColorController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Item Colors',
);

$this->menu=array(
	array('label'=>'Create ItemColor','url'=>array('create')),
	array('label'=>'Manage ItemColor','url'=>array('admin')),
);
?>

<h1>Item Colors</h1>

<?php $this->widget('\TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>