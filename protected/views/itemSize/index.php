<?php
/* @var $this ItemSizeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Item Sizes',
);

$this->menu=array(
	array('label'=>'Create ItemSize','url'=>array('create')),
	array('label'=>'Manage ItemSize','url'=>array('admin')),
);
?>

<h1>Item Sizes</h1>

<?php $this->widget('\TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>