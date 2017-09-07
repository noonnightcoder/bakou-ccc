<?php
/* @var $this ItemSizeController */
/* @var $model ItemSize */


$this->breadcrumbs=array(
	Yii::t('app','Size')=>array('admin'),
	Yii::t('app','Manage'),
);

$this->menu=array(
	array('label'=>'List ItemSize', 'url'=>array('index')),
	array('label'=>'Create ItemSize', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#item-size-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

    <?php $this->widget('ext.modaldlg.EModalDlg'); ?>

<div id="item_size_wrapper">
    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message .
            '<button class="close" data-dismiss="alert" type="button">
                        <i class="ace-icon fa fa-times"></i>
                    </button>' .
            "</div>\n";
    }
    ?>

	<div class="page-header">
		<div class="nav-search search-form" id="nav-search">
			<?php $this->renderPartial('_search', array(
				'model' => $model,
			)); ?>
		</div>

		<a class="btn btn-app btn-success" href="<?php echo $this->createUrl('create'); ?>">
			<i class="ace-icon fa fa-plus bigger-230"></i>
			<?php echo Yii::t('app','New Size'); ?>
		</a>

		<?php echo CHtml::activeCheckBox($model, 'archived', array(
			'value' => 1,
			'uncheckValue' => 0,
			'checked' => ($model->archived == 'false') ? false : true,
			'onclick' => "$.fn.yiiGridView.update('item-size-grid',{data:{archived:$(this).is(':checked')}});"
		)); ?>

		<?= Yii::t('app','Show archived/deleted Size'); ?>

	</div>

    <?php
    $pageSize = Yii::app()->user->getState('pageSizeItemSize', Yii::app()->params['defaultPageSize']);
    $pageSizeDropDown = CHtml::dropDownList(
        'pageSize',
        $pageSize,
        array(10 => 10, 25 => 25, 50 => 50, 100 => 100),
        array(
            'class' => 'change-pagesize',
            'onchange' => "$.fn.yiiGridView.update('item-size-grid',{data:{pageSize:$(this).val()}});",
        )
    );
    ?>


    <?php $this->widget('\TbGridView',array(
        'id'=>'item-size-grid',
        'template' => "{items}\n{summary}\n{pager}",
        'summaryText' => 'Showing {start}-{end} of {count} entries ' . $pageSizeDropDown . ' rows per page',
        'htmlOptions' => array('class' => 'table-responsive panel'),
        'dataProvider'=>$model->search(),
        'columns'=>array(
            //'id',
            'name',
            'full_name',
            //'status',
            'create_at',
            'update_at',
            /*
            'create_by',
            'update_by',
            */
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'header' => Yii::t('app', 'Action'),
                'template'=>'<div class="hidden-sm hidden-xs btn-group">{view}{update}{delete}{restore}</div>',
                //'htmlOptions'=>array('class'=>'hidden-sm hidden-xs btn-group'),
                'buttons' => array(
                    'view' => array(
                        'click' => 'updateDialogOpen',
                        'url' => 'Yii::app()->createUrl("ItemSize/view/",array("id"=>$data->id))',
                        'icon' => 'bigger-120 glyphicon-eye-open',
                        'options' => array(
                            'class' => 'btn btn-xs btn-success',
                            'data-update-dialog-title' => Yii::t('app', 'View Item'),
                        ),
                        'visible' => '$data->status=="1"',
                    ),
                    'update' => array(
                        'url' => 'Yii::app()->createUrl("ItemSize/Update", array("id"=>$data->id))',
                        'label' => Yii::t('app', 'Edit Item Size'),
                        'icon' => 'bigger-120 glyphicon-edit',
                        'options' => array(
                            'titile' => 'Edit Item Size',
                            'class' => 'btn btn-xs btn-info',
                        ),
                        'visible' => '$data->status=="1"',
                    ),
                    'delete' => array(
                        'label' => Yii::t('app', 'Delete Item Size'),
                        'icon'=>'bigger-120 glyphicon-trash',
                        'options' => array(
                            'data-update-dialog-title' => Yii::t('app', 'form.item._form.header_update'),
                            'titile' => 'Edit Item',
                            'class' => 'btn btn-xs btn-danger',
                        ),
                        'visible' => '$data->status=="1"',
                    ),
                    'restore' => array(
                        'label' => Yii::t('app', 'Restore Item Sieze'),
                        'url' => 'Yii::app()->createUrl("ItemSize/restore", array("id"=>$data->id))',
                        'icon' => 'bigger-120 glyphicon-refresh',
                        'options' => array(
                            'class' => 'btn btn-xs btn-warning btn-restore',
                        ),
                        'visible' => '$data->status=="0"',
                    ),
                ),
            ),
        ),
    )); ?>

</div>

<?php
Yii::app()->clientScript->registerScript('restoreItem', "
        jQuery( function($){
            $('div#item_size_wrapper').on('click','a.btn-restore',function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to do restore this item?')) {
                    return false;
                }
                var url=$(this).attr('href');
                $.ajax({url:url,
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                            $.fn.yiiGridView.update('item-size-grid');
                            return false;
                          }
                    });
                });
        });
      ");
?>
