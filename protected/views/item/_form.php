<div class="form">

    <?php $form = $this->beginWidget('\TbActiveForm', array(
        'id' => 'item-form',
        'enableAjaxValidation' => false,
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->textFieldControlGroup($model, 'barcode', array('span' => 5, 'maxlength' => 30)); ?>

    <?php echo $form->textFieldControlGroup($model, 'item_number', array('span' => 5, 'maxlength' => 30)); ?>

    <?php //echo $form->textFieldControlGroup($model, 'size_id', array('span' => 5)); ?>


    <div class="form-group <?= $validation_class; ?>">
        <label class="col-sm-3 control-label required" for="Item_size"><?php echo Yii::t('app','Size') ?> <span class="required">*</span></label>
        <div class="col-md-5">
            <?php
            $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                'asDropDownList' => false,
                'model'=> $model,
                'attribute'=>'size_id',
                'pluginOptions' => array(
                    'placeholder' => Yii::t('app','Size') . ' (M, L , XL, XXL)',
                    'multiple'=>false,
                    'width' => '100%',
                    //'tokenSeparators' => array(',', ' '),
                    'allowClear'=>true,
                    //'minimumInputLength'=>1,
                    'ajax' => array(
                        'url' => Yii::app()->createUrl('ItemSize/sizeOption/'),
                        'dataType' => 'json',
                        'cache'=>true,
                        'data' => 'js:function(term,page) {
                                            return {
                                                term: term,
                                                page_limit: 10,
                                                quietMillis: 100,
                                                apikey: "e5mnmyr86jzb9dhae3ksgd73"
                                            };
                                        }',
                        'results' => 'js:function(data,page){
                                    return { results: data.results };
                                 }',
                    ),
                    'initSelection' => "js:function (element, callback) {
                                    var id=$(element).val();
                                    if (id!=='') {
                                        $.ajax('".$this->createUrl('/itemSize/initSize')."', {
                                            dataType: 'json',
                                            data: { id: id }
                                        }).done(function(data) {callback(data);}); //http://www.eha.ee/labs/yiiplay/index.php/en/site/extension?view=select2
                                    }
                            }",
                    'createSearchChoice' => 'js:function(term, data) {
                                if ($(data).filter(function() {
                                    return this.text.localeCompare(term) === 0;
                                }).length === 0) {
                                    return {id:term, text: term, isNew: true};
                                }
                            }',
                    'formatResult' => 'js:function(term) {
                                if (term.isNew) {
                                    return "<span class=\"label label-important\">New</span> " + term.text;
                                }
                                else {
                                    return term.text;
                                }
                            }',
                )));
            ?>
        </div>
    </div>

    <div class="form-group <?= $validation_class; ?>">
        <label class="col-sm-3 control-label required" for="Item_color"><?php echo Yii::t('app','Color') ?> <span class="required">*</span></label>
        <div class="col-md-5">
            <?php
            $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                'asDropDownList' => false,
                'model'=> $model,
                'attribute'=>'color_id',
                'pluginOptions' => array(
                    'placeholder' => Yii::t('app','Color'),
                    'multiple'=>false,
                    'width' => '100%',
                    //'tokenSeparators' => array(',', ' '),
                    'allowClear'=>true,
                    //'minimumInputLength'=>1,
                    'ajax' => array(
                        'url' => Yii::app()->createUrl('ItemColor/colorOption/'),
                        'dataType' => 'json',
                        'cache'=>true,
                        'data' => 'js:function(term,page) {
                                            return {
                                                term: term,
                                                page_limit: 10,
                                                quietMillis: 100,
                                                apikey: "e5mnmyr86jzb9dhae3ksgd73"
                                            };
                                        }',
                        'results' => 'js:function(data,page){
                                    return { results: data.results };
                                 }',
                    ),
                    'initSelection' => "js:function (element, callback) {
                                    var id=$(element).val();
                                    if (id!=='') {
                                        $.ajax('".$this->createUrl('/ItemColor/initColor')."', {
                                            dataType: 'json',
                                            data: { id: id }
                                        }).done(function(data) {callback(data);}); //http://www.eha.ee/labs/yiiplay/index.php/en/site/extension?view=select2
                                    }
                            }",
                    'createSearchChoice' => 'js:function(term, data) {
                                if ($(data).filter(function() {
                                    return this.text.localeCompare(term) === 0;
                                }).length === 0) {
                                    return {id:term, text: term, isNew: true};
                                }
                            }',
                    'formatResult' => 'js:function(term) {
                                if (term.isNew) {
                                    return "<span class=\"label label-important\">New</span> " + term.text;
                                }
                                else {
                                    return term.text;
                                }
                            }',
                )));
            ?>
        </div>
    </div>

    <?php //echo $form->textFieldControlGroup($model, 'color_id', array('span' => 5)); ?>

    <?php echo $form->textFieldControlGroup($model, 'name', array('span' => 5, 'maxlength' => 60)); ?>

    <?php echo $form->textFieldControlGroup($model, 'name_jp', array('span' => 5, 'maxlength' => 60)); ?>

    <?php echo $form->fileFieldControlGroup($model, 'image'); ?>

    <?php if(!$model->isNewRecord){ ?>
    <div class="row">
        <label class="col-sm-3 control-label" for="image_show"></label>
        <div class="col-md-5">
            <?php echo CHtml::image(Yii::app()->request->baseUrl . '/ximages/' . $model->image,"Image Show",array("width"=>200)); ?>
        </div>
    </div>
    <?php } ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->