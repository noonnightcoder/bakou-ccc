<?php
$this->breadcrumbs=array(
	Yii::t('app','Item')=>array('admin'),
	Yii::t('app','Manage'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#item-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('ext.modaldlg.EModalDlg'); ?>

<div id="item_wrapper">

    <div id="flash">
        <?php $this->renderPartial('//layouts/partial/_flash_message'); ?>
    </div>

    <?php $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
        'title' => Yii::t('app', 'List of Items'),
        'headerIcon' => 'ace-icon fa fa-list',
        'htmlHeaderOptions' => array('class' => 'widget-header-flat widget-header-small'),
    )); ?>

        <div class="page-header">
            <div class="nav-search search-form" id="nav-search">
                <?php $this->renderPartial('_search', array(
                    'model' => $model,
                )); ?>
            </div>

        <?php $form=$this->beginWidget('CActiveForm', array(
            'enableAjaxValidation'=>true,
            'id' => 'item-form'
        )); ?>

            <a class="btn btn-app btn-success" href="<?php echo $this->createUrl('create'); ?>">
                <i class="ace-icon fa fa-plus bigger-230"></i>
                <?php echo Yii::t('app','New Item'); ?>
            </a>

            <!--<a class="btn btn-app btn-success btn-recount" href="<?php /*echo $this->createUrl('Recount'); */?>">
                <i class="ace-icon fa fa-refresh bigger-230"></i>
                <?php /*echo Yii::t('app','Re-count'); */?>
            </a>-->

            <?php //echo CHtml::ajaxSubmitButton('Re-count',array('item/Recount','act'=>'doActive')); ?>

            <?php /*echo TbHtml::linkButton(Yii::t('app', 'New Item'), array(
                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                'size' => TbHtml::BUTTON_SIZE_SMALL,
                'icon' => 'ace-icon fa fa-plus white',
                'url' => $this->createUrl('create'),
            )); */?>

            <?php echo CHtml::activeCheckBox($model, 'archived', array(
                'value' => 1,
                'uncheckValue' => 0,
                'checked' => ($model->archived == 'false') ? false : true,
                'onclick' => "$.fn.yiiGridView.update('item-grid',{data:{archived:$(this).is(':checked')}});"
            )); ?>

            <?= Yii::t('app','Show archived/deleted Item'); ?>

        </div>

        <?php
        $pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
        $pageSizeDropDown = CHtml::dropDownList(
            'pageSize',
            $pageSize,
            array(10 => 10, 25 => 25, 50 => 50, 100 => 100),
            array(
                'class' => 'change-pagesize',
                'onchange' => "$.fn.yiiGridView.update('item-grid',{data:{pageSize:$(this).val()}});",
            )
        );
        ?>

        <?php $this->widget('\TbGridView',array(
            'id'=>'item-grid',
            'template' => "{items}\n{summary}\n{pager}",
            'summaryText' => 'Showing {start}-{end} of {count} entries ' . $pageSizeDropDown . ' rows per page',
            'htmlOptions' => array('class' => 'table-responsive panel'),
            'dataProvider'=> $model->search(),
            //'filter'=>$model,
            'columns'=>array(
               /* array(
                    'id'=>'autoId',
                    'class'=>'CCheckBoxColumn',
                    'selectableRows' => '50',
                ),*/
                'name',
                'barcode',
                'item_number',
                array(
                    'name' => 'size_id',
                    'value' => '$data->size_id==null? " " : $data->size->name',
                ),
                array(
                    'name' => 'color_id',
                    'value' => '$data->color_id==null? " " : $data->color->name',
                ),
                array(
                    'name' => 'scan_correct',
                    'value' => array($this, "gridCorrectScan"),
                    'type' => 'raw',
                ),
                array(
                    'name' => 'scan_incorrect',
                    'value' => array($this, "gridIncorrectScan"),
                    'type' => 'raw',
                ),
                /*
                'name_jp',
                'status',
                'create_at',
                'update_at',
                'create_by',
                'update_by',
                */
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'header' => Yii::t('app', 'Action'),
                    'template'=>'<div class="hidden-sm hidden-xs btn-group">{view}{recount}{update}{delete}{restore}</div>',
                    //'htmlOptions'=>array('class'=>'hidden-sm hidden-xs btn-group'),
                    'buttons' => array(
                        'view' => array(
                            'click' => 'updateDialogOpen',
                            'url' => 'Yii::app()->createUrl("Item/view/",array("id"=>$data->id))',
                            'icon' => 'bigger-120 glyphicon-eye-open',
                            'options' => array(
                                'class' => 'btn btn-xs btn-success',
                                'data-update-dialog-title' => Yii::t('app', 'View Item'),
                            ),
                        ),
                        'recount' => array(
                            'url' => 'Yii::app()->createUrl("Item/Recount", array("id"=>$data->id))',
                            'label' => Yii::t('app', 'Re-count'),
                            'icon' => 'bigger-120 fa fa-archive',
                            'options' => array(
                                'titile' => 'Re-count',
                                'class' => 'btn btn-xs btn-primary btn-recount',
                            ),
                        ),
                        'update' => array(
                            'url' => 'Yii::app()->createUrl("Item/Update", array("id"=>$data->id))',
                            'label' => Yii::t('app', 'Edit Item'),
                            'icon' => 'bigger-120 glyphicon-edit',
                            'options' => array(
                                'data-update-dialog-title' => Yii::t('app', 'form.item._form.header_update'),
                                'titile' => 'Edit Item',
                                //'data-refresh-grid-id'=>'item-grid',
                                'class' => 'btn btn-xs btn-info',
                            ),
                            'visible' => '$data->status=="1"',
                        ),
                        'delete' => array(
                            'label' => Yii::t('app', 'Delete Item'),
                            'icon'=>'bigger-120 glyphicon-trash',
                            'options' => array(
                                'data-update-dialog-title' => Yii::t('app', 'form.item._form.header_update'),
                                'titile' => 'Edit Item',
                                'class' => 'btn btn-xs btn-danger',
                            ),
                            'visible' => '$data->status=="1"',
                        ),
                        'restore' => array(
                            'label' => Yii::t('app', 'Restore Item'),
                            'url' => 'Yii::app()->createUrl("Item/restore", array("id"=>$data->id))',
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

    <?php $this->endWidget(); ?>

    <?php $this->endWidget(); ?>

</div>

<?php
Yii::app()->clientScript->registerScript('restoreItem', "
        jQuery( function($){
            $('div#item_wrapper').on('click','a.btn-restore',function(e) {
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
                            $.fn.yiiGridView.update('item-grid');
                            return false;
                          }
                    });
                });
        });
      ");
?>

<script>
    $(document).ready(function()
    {
        $('#item_wrapper').on('click','a.btn-recount', function(e) {
            e.preventDefault();
            if (!confirm('<?= Yii::t('app','Are you sure you want to re-counting this item?'); ?>')) {
                return false;
            }
            var url=$(this).attr('href');
            //var data=$("#item-form").serialize();
            $.ajax({url:url,
                type : 'post',
                beforeSend: function() { $('.waiting').show(); },
                complete: function() { $('.waiting').hide(); },
                success : function(data) {
                    $.fn.yiiGridView.update('item-grid');
                    $('#flash').html(data);
                    return false;
                }
            });
        });
    });
</script>