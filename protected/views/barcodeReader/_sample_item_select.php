<div class="page-header">
    <h1>
        <i class="fa fa-cog fa-spin"></i>
        <?= Yii::t('app','Working Area'); ?>
    </h1>
</div>

<div class="row">

    <div class="col-xs-12 col-sm-6">
        <h1 class="header smaller lighter orange">
            <i class="ace-icon fa fa-spinner fa-spin orange"></i>
            <?= Yii::t('app','Scanning Item'); ?>
        </h1>
        <div id="item_zone">
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'action' => Yii::app()->createUrl('barcodeReader/add'),
                    'method' => 'post',
                    'layout' => TbHtml::FORM_LAYOUT_INLINE,
                    'id' => 'add_item_form',
                )); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'model' => $model,
                        'attribute' => 'id',
                        'source' => $this->createUrl('request/suggestItem'),
                        'htmlOptions' => array(
                            'size' => '50'
                        ),
                        'options' => array(
                            'showAnim' => 'fold',
                            'minLength' => '1',
                            'delay' => 10,
                            'autoFocus' => true,
                            'select' => 'js:function(event, ui) {
                                 event.preventDefault();
                                 $("#Item_id").val(ui.item.id);
                                 $("#add_item_form").ajaxSubmit({target: "#register_container", beforeSubmit: beforeSubmit, success: itemScannedSuccess() });
                             }',
                        ),
                    ));
                    ?>
                <?php $this->endWidget(); ?> <!--/endformWidget-->

            <!--<ul class="ace-thumbnails clearfix">
                <br />
                <h5><?/*= Yii::t('app','Your are currently working on product numbers:'); */?></h5>

                <?php /*foreach($sample_items as $i=>$sample_item) { */?>
                    <li>
                        <a class="cboxElement" data-rel="colorbox" href="#">
                            <img width="200" height="200" src="<?/*= Yii::app()->request->baseUrl . '/ximages/' . $sample_item['image']; */?>" alt="150x150">
                            <div class="tags">
                                    <span class="label-holder">
                                        <span class="label label-info"><?/*= $sample_item['barcode'] */?></span>
                                    </span>
                                    <span class="label-holder">
                                        <span class="label label-danger"><?/*= $sample_item['name'] */?></span>
                                    </span>

                                    <span class="label-holder">
                                        <span class="label label-success"><?/*= $sample_item['color_name'] */?></span>
                                    </span>

                                    <span class="label-holder">
                                        <span class="label label-warning arrowed-in"><?/*= $sample_item['size'] */?></span>
                                    </span>
                            </div>
                        </a>
                    </li>
                <?php /*} */?>
            </ul>-->

            <h5><?= Yii::t('app','Your are currently working on product numbers:'); ?></h5>

            <div class="thumbnail clearfix">
                <?php foreach($sample_items as $i=>$sample_item) { ?>
                    <img src="<?= Yii::app()->request->baseUrl . '/ximages/' . $sample_item['image']; ?>" class="pull-left" width="150" height="120">
                    <div class="caption" class="pull-right">
                        <h5><?= Yii::t('app','Item Number') . ' : ' . $sample_item['item_number']; ?></h5>
                        <h5><?= Yii::t('app','Item Name') . ' : ' . $sample_item['name']; ?></h5>
                        <h5><?= Yii::t('app','Size') . ' : ' . $sample_item['size']; ?></h5>
                        <h5><?= Yii::t('app','Color') . ' : ' . $sample_item['color_name']; ?></h5>
                    </div>
                <?php } ?>
            </div>

        </div>

    </div>

    <div class="col-xs-12 col-sm-6">
        <h1 class="header smaller lighter green">
            <i class="ace-icon fa fa-bullhorn"></i>
            <?= Yii::t('app','Notification & Dashboard'); ?>
        </h1>

        <div id="notification_zone">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#all">
                            <i class="green ace-icon fa fa-calendar-o bigger-120"></i>
                            <?= Yii::t('app','Total'); ?>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#today">
                            <i class="green ace-icon fa fa-calendar-o bigger-120"></i>
                            <?= Yii::t('app','Today'); ?>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#yesterday">
                            <i class="orange ace-icon fa fa-calendar-o bigger-120"></i>
                            <?= Yii::t('app','Yesterday'); ?>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="all" class="tab-pane fade in active">
                        <p>
                            <?php foreach($trans_status_all as $tran_status) { ?>
                                <?php $infobox_color = $tran_status['scan_status'] =='Correct' ? 'infobox-green' : 'infobox-red'; ?>
                                <div class="infobox <?php echo $infobox_color; ?>">
                                    <div class="infobox-icon">
                                        <i class="ace-icon fa fa-magic icon-animated-bell"></i>
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number"><?= $tran_status['ncount']; ?></span>
                                        <div class="infobox-content"><?php echo CHtml::link(Yii::t('app',$tran_status['scan_status']), Yii::app()->createUrl("report/SaleReportTab")); ?></div>
                                    </div>
                                </div>
                             <?php } ?>
                        </p>

                        <?php $this->renderPartial('_grid_scan', array(
                            'grid_id' => $grid_id,
                            'grid_columns' => $grid_columns,
                            'data_provider' => $data_provider,
                        )); ?>

                    </div>

                    <div id="today" class="tab-pane fade">
                        <p>
                            <?php foreach($trans_status_today as $tran_status) { ?>
                             <?php $infobox_color = $tran_status['scan_status'] =='Correct' ? 'infobox-green' : 'infobox-red'; ?>
                                <div class="infobox <?php echo $infobox_color; ?>">
                                    <div class="infobox-icon">
                                        <i class="ace-icon fa fa-magic icon-animated-bell"></i>
                                    </div>
                                    <div class="infobox-data">
                                        <span class="infobox-data-number"><?= $tran_status['ncount']; ?></span>
                                        <div class="infobox-content"><?php echo CHtml::link(Yii::t('app',$tran_status['scan_status']), Yii::app()->createUrl("report/SaleReportTab")); ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </p>

                    </div>

                    <div id="yesterday" class="tab-pane fade">
                        <?php foreach($trans_status_yesterday as $tran_status) { ?>
                            <?php $infobox_color = $tran_status['scan_status'] =='Passed' ? 'infobox-green' : 'infobox-red'; ?>
                            <div class="infobox <?php echo $infobox_color; ?>">
                                <div class="infobox-icon">
                                    <i class="ace-icon fa fa-magic icon-animated-bell"></i>
                                </div>
                                <div class="infobox-data">
                                    <span class="infobox-data-number"><?= $tran_status['ncount']; ?></span>
                                    <div class="infobox-content"><?php echo CHtml::link($tran_status['scan_status'], Yii::app()->createUrl("report/SaleReportTab")); ?></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php if (isset($alert_type) && $alert_type=='item_not_correct') { ?>
                <div id="alerts">
                    <audio id="audioplayer" autoplay=true>
                        <source src="<?php echo Yii::app()->baseUrl; ?>/sound/incorrect.mp3" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    <script>
                        bootbox.alert("<h3> <?php echo Yii::t('app','Product entered is not correct'); ?> </h3>");
                    </script>
            <?php } elseif(isset($alert_type) && $alert_type=='success') { ?>
                    <audio id="audioplayer" autoplay=true>
                        <source src="<?php echo Yii::app()->baseUrl; ?>/sound/ping.mp3" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
            <?php } elseif(isset($alert_type) && $alert_type =='item_not_found') { ?>
                    <audio id="audioplayer" autoplay=true>
                        <source src="<?php echo Yii::app()->baseUrl; ?>/sound/impact.mp3" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
				</div>
            <?php } ?>

            <br />

            <?php $this->renderPartial('//layouts/partial/_flash_message'); ?>

        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-3 col-md-offset-4">
        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'scan_item_select_form',
            'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
            'action'=>Yii::app()->createUrl('barcodeReader/resetSample'),
        )); ?>

        <a class="btn btn-white btn-info btn-round btn-xlg btn-reset-sample" href="<?= Yii::app()->createUrl('resetSample'); ?>">
            <i class="ace-icon fa fa-recycle bigger-200"></i>
            <span style="font-size:22px;"><?= Yii::t('app','Click here to start another code'); ?> </span>
        </a>
        <?php $this->endWidget(); ?>
    </div>
</div>
