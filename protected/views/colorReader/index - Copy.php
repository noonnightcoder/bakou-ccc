<div id="register_container">

    <!-- #section:second.div.layout -->
    <div class="col-xs-12 col-sm-6 widget-container-col">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h5 class="widget-title bigger lighter">Select Color</h5>

                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up bigger-125"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body" id="color_zone">
                <div class="widget-main padding-12">

                    <div id="color_lookup">
                        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                            'action'=>Yii::app()->createUrl('colorReader/add'),
                            'method'=>'post',
                            'layout'=>TbHtml::FORM_LAYOUT_INLINE,
                            'id'=>'add_item_form',
                        )); ?>

                        <?php //if (isset($table_id)) { ?>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'model'=>$model,
                            'attribute'=>'id',
                            'source'=>$this->createUrl('request/suggestColor'),
                            'htmlOptions'=>array(
                                'size'=>'35'
                            ),
                            'options'=>array(
                                'showAnim'=>'fold',
                                'minLength'=>'1',
                                'delay' => 10,
                                'autoFocus'=> false,
                                'select'=>'js:function(event, ui) {
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
                    </div> <Br />

                    <?php foreach ($color_codes as $color_code) { ?>

                        <?php if ($color_code["id"] == $color_id) { ?>
                            <a class="btn btn-white btn-success btn-round btn-lg color-btn active"
                               href="<?php echo Yii::app()->createUrl('colorReader/setColor/',
                                   array('id' => $color_code['id'])); ?>">
                                <i class="ace-icon fa fa-check-circle bigger-290" style="color:<?php echo $color_code['color_code_name']; ?>"></i>
                                    <span style="font-size:22px;"><?php echo $color_code['col'] ?> </span>
                                <span class="badge badge-info white"><?php echo $color_code["size"]; ?></span>
                            </a>
                        <?php } else { ?>
                            <a class="btn btn-white btn-success btn-round btn-lg color-btn"
                               href="<?php echo Yii::app()->createUrl('colorReader/setColor/',
                                   array('id' => $color_code['id'])); ?>">
                                <i class="ace-icon fa fa-circle bigger-290" style="color:<?php echo $color_code['color_code_name']; ?>" ></i>
                                <?php echo $color_code['col'] ?>
                            </a>
                        <?php } ?>

                    <?php } ?>

                </div>

                <div class="widget-toolbox padding-8 clearfix">
                </div>
            </div>

        </div>

        <i class="ace-icon fa fa-book"></i>
        <?php echo TbHtml::tooltip('Keyboard Shortcuts Help', '#',
            '[F2] => Set the focus to "Giftcard #" <br>
             [F1] => Set the focus to "Payment Amount" [Enter] to make payment, Press another [Enter] to Complete Sale',
            array('data-html' => 'true', 'placement' => TbHtml::TOOLTIP_PLACEMENT_TOP,)
        ); ?>
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
    </div>


    <?php $this->renderPartial('_partial_index'); ?>

</div>


<div class="waiting"><!-- Place at bottom of page --></div>

