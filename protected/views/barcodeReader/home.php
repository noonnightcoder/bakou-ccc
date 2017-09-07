<h1> <?= Yii::t('app','Scan your sample to start your day!!!'); ?> </h1>

<div id="item_lookup">
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl('barcodeReader/scanSample'),
        'method' => 'post',
        'layout' => TbHtml::FORM_LAYOUT_INLINE,
        'id' => 'scan_sample_form',
    )); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'model' => $model,
            'attribute' => 'id',
            'source' => $this->createUrl('request/suggestItem'),
            'htmlOptions' => array(
                'size' => '70'
            ),
            'options' => array(
                'showAnim' => 'fold',
                'minLength' => '1',
                'delay' => 10,
                'autoFocus' => false,
                'select' => 'js:function(event, ui) {
                     event.preventDefault();
                     $("#ColorCode_id").val(ui.item.id);
                     $("#scan_sample_form").ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: itemScannedSuccess() });
                }',
            ),
        ));
        ?>
    <?php $this->endWidget(); ?> <!--/endformWidget-->
</div>

<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message .
        '<button class="close" data-dismiss="alert" type="button">
                    <i class="ace-icon fa fa-times"></i>
                </button>' .
        "</div>\n";
}
?>

<?php Yii::app()->clientScript->registerScript('setFocus', '$("#Item_id").focus();'); ?>
