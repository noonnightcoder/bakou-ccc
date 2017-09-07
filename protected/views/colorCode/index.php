<?php
/* @var $this ColorCodeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Color Codes',
);

$this->menu=array(
	array('label'=>'Create ColorCode','url'=>array('create')),
	array('label'=>'Manage ColorCode','url'=>array('admin')),
);
?>

<h1>Color Codes</h1>

<?php $this->widget('\TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>