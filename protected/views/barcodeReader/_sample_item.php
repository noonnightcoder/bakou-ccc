<?php $this->renderPartial('//layouts/partial/_flash_message'); ?>

<div class="page-header">
    <h1> <?= Yii::t('app','Please enter product barcode you wish to scan'); ?> </h1>
</div>

<div class="col-xs-12 col-sm-6">

    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl('barcodeReader/scanSample'),
        'method' => 'post',
        'layout' => TbHtml::FORM_LAYOUT_INLINE,
        'id' => 'scan_item_form',
    )); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'model' => $model,
            'attribute' => 'id',
            'source' => $this->createUrl('request/suggestItem'),
            'htmlOptions' => array(
                'size' => '40'
            ),
            'options' => array(
                'showAnim' => 'fold',
                'minLength' => '1',
                'delay' => 10,
                'autoFocus' => true,
                'select' => 'js:function(event, ui) {
                     event.preventDefault();
                     $("#Item_id").val(ui.item.id);
                     $("#scan_item_form").ajaxSubmit({target: "#register_container", beforeSubmit: beforeSubmit, success: itemScannedSuccess() });
                }',
            ),
        ));
        ?>
    <?php $this->endWidget(); ?>
</div>
