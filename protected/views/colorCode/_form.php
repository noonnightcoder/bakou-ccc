<div class="form">

    <?php $form=$this->beginWidget('\TbActiveForm', array(
	    'id'=>'color-code-form',
        'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->textFieldControlGroup($model,'barcode_number',array('span'=>7,'maxlength'=>20)); ?>

            <?php echo $form->textFieldControlGroup($model,'size',array('span'=>7,'maxlength'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'no',array('span'=>7,'maxlength'=>10)); ?>

            <?php echo $form->textFieldControlGroup($model,'col',array('span'=>7,'maxlength'=>50)); ?>

            <?php echo $form->textFieldControlGroup($model,'col_description',array('span'=>7,'maxlength'=>50)); ?>

            <?php echo $form->textFieldControlGroup($model,'color_code_name',array('span'=>7,'maxlength'=>30)); ?>

            <?php echo $form->textFieldControlGroup($model,'qual',array('span'=>7,'maxlength'=>30)); ?>

    <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->