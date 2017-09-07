<div id="register_container">

    <!-- #section:second.div.layout -->
    <div class="col-xs-12 col-sm-6">
        <h3 class="header smaller lighter orange">
            <i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i>
            Color Setting
        </h3>

        <div id="color_zone">
            <div id="color_lookup">
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'action' => Yii::app()->createUrl('colorReader/add'),
                    'method' => 'post',
                    'layout' => TbHtml::FORM_LAYOUT_INLINE,
                    'id' => 'add_item_form',
                )); ?>

                <?php //if (isset($table_id)) { ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model' => $model,
                    'attribute' => 'id',
                    'source' => $this->createUrl('request/suggestColor'),
                    'htmlOptions' => array(
                        'size' => '35'
                    ),
                    'options' => array(
                        'showAnim' => 'fold',
                        'minLength' => '1',
                        'delay' => 10,
                        'autoFocus' => false,
                        'select' => 'js:function(event, ui) {
                                         event.preventDefault();
                                         $("#ColorCode_id").val(ui.item.id);
                                         $("#add_item_form").ajaxSubmit({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: itemScannedSuccess() });
                                     }',
                    ),
                ));
                ?>
                <?php //} ?>

                <span class="label label-info label-xlg">
                         <i class="fa fa-coffee"></i>
                     </span>

                <?php $this->endWidget(); ?> <!--/endformWidget-->
            </div>
            <br/>

            <?php foreach ($color_codes as $color_code) { ?>

                <?php if ($color_code["id"] == $color_id) { ?>
                    <a class="btn btn-white btn-success btn-round btn-lg color-btn active"
                       href="<?php echo Yii::app()->createUrl('colorReader/setColor/',
                           array('id' => $color_code['id'])); ?>">
                        <i class="ace-icon fa fa-check-circle bigger-290"
                           style="color:<?php echo $color_code['color_code_name']; ?>"></i>
                        <span style="font-size:22px;"><?php echo $color_code['col'] ?> </span>
                        <span class="badge badge-info white"><?php echo $color_code["size"]; ?></span>
                    </a>
                <?php } else { ?>
                    <a class="btn btn-white btn-success btn-round btn-lg color-btn"
                       href="<?php echo Yii::app()->createUrl('colorReader/setColor/',
                           array('id' => $color_code['id'])); ?>">
                        <i class="ace-icon fa fa-circle bigger-290"
                           style="color:<?php echo $color_code['color_code_name']; ?>"></i>
                        <?php echo $color_code['col'] ?>
                    </a>
                <?php } ?>

            <?php } ?>

        </div>

    </div>

    <div class="col-xs-12 col-sm-6">
        <h3 class="header smaller lighter green">
            <i class="ace-icon fa fa-bullhorn"></i>
            Alerts
        </h3>
        <?php
        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
        }
        ?>

        <?php if (isset($alert) && $alert=='danger') { ?>
            <div id="alerts">
                <audio id="audioplayer" autoplay=true>
                    <source src="<?php echo Yii::app()->baseUrl; ?>/sound/incorrect.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        <?php } ?>

    </div>

    <?php $this->renderPartial('_partial_index'); ?>

</div>


<div class="waiting"><!-- Place at bottom of page --></div>

