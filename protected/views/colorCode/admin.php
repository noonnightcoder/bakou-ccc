<?php $this->widget('ext.modaldlg.EModalDlg'); ?>

<?php
$this->breadcrumbs=array(
	'Color Code'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#color-code-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="row" id="item_cart">
    <div class="col-xs-12 widget-container-col ui-sortable">

        <div class="page-header">
            <div class="nav-search" id="nav-search">
                <?php $this->renderPartial('_search', array(
                    'model' => $model,
                )); ?>
            </div>

            <a class="btn btn-app btn-success update-dialog-open-link" href="<?php echo $this->createUrl('create'); ?>"  data-refresh-grid-id="color-code-grid" data-update-dialog-title="New Color Code">
                <i class="ace-icon fa fa-plus bigger-230"></i>
                <?php echo Yii::t('app','Add Color'); ?>
            </a>

            <?php echo CHtml::activeCheckBox($model, 'item_archived', array(
                'value' => 1,
                'uncheckValue' => 0,
                'checked' => ($model->archived == 'false') ? false : true,
                'onclick' => "$.fn.yiiGridView.update('color-code-grid',{data:{archived:$(this).is(':checked')}});"
            )); ?>

            Show archived/deleted <b>Color Code</b>

        </div>

        <?php
        $pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
        $pageSizeDropDown = CHtml::dropDownList(
            'pageSize',
            $pageSize,
            array(10 => 10, 25 => 25, 50 => 50, 100 => 100),
            array(
                'class' => 'change-pagesize',
                'onchange' => "$.fn.yiiGridView.update('color-code-grid',{data:{pageSize:$(this).val()}});",
            )
        );
        ?>

        <?php $this->widget('\TbGridView', array(
            'id' => 'color-code-grid',
            'template' => "{items}\n{summary}\n{pager}",
            'summaryText' => 'Showing {start}-{end} of {count} entries ' . $pageSizeDropDown . ' rows per page',
            'htmlOptions' => array('class' => 'table-responsive panel'),
            'dataProvider' => $model->search(),
            'columns' => array(
                'id',
                'barcode_number',
                'no',
                'size',
                'col',
                'col_description',
                'qual',
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'header' => Yii::t('app', 'Action'),
                    'template' => '<div class="hidden-sm hidden-xs btn-group">{view}{update}{delete}{restore}</div>',
                    'htmlOptions' => array('class' => 'nowrap'),
                    'buttons' => array(
                        'view' => array(
                            'click' => 'updateDialogOpen',
                            'url' => 'Yii::app()->createUrl("colorCode/view/",array("id"=>$data->id))',
                            'options' => array(
                                'class' => 'btn btn-xs btn-success',
                                'data-update-dialog-title' => Yii::t('app', 'View Color Code'),
                            ),
                        ),
                        'update' => array(
                            'icon' => 'ace-icon fa fa-edit',
                            'label' => Yii::t('app', 'Update Color Code'),
                            'click' => 'updateDialogOpen',
                            'options' => array(
                                'class' => 'btn btn-xs btn-info',
                                'data-refresh-grid-id' => 'color-code-grid'
                            ),
                        ),
                        'delete' => array(
                            'label' => Yii::t('app', 'Delete'),
                            'url' => 'Yii::app()->createUrl("colorCode/delete", array("id"=>$data->id))',
                            'options' => array(
                                'class' => 'btn btn-xs btn-danger',
                            ),
                            'visible' => '$data->status=="1"',
                        ),
                        'restore' => array(
                            'label' => Yii::t('app', 'Undo Delete Item'),
                            'url' => 'Yii::app()->createUrl("colorCode/restore", array("id"=>$data->id))',
                            'icon' => 'bigger-120 glyphicon-refresh',
                            'options' => array(
                                'class' => 'btn btn-xs btn-warning btn-undodelete',
                            ),
                            'visible' => '$data->status=="0"',
                        ),
                    ),
                ),
            ),
        )); ?>

    </div>
</div>

<?php
Yii::app()->clientScript->registerScript('undoDelete', "
        jQuery( function($){
            $('div#item_cart').on('click','a.btn-undodelete',function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to do restore this Item?')) {
                    return false;
                }
                var url=$(this).attr('href');
                $.ajax({url:url,
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                            $.fn.yiiGridView.update('color-code-grid');
                            return false;
                          }
                    });
                });
        });
      ");
?>