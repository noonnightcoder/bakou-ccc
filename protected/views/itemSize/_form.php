<div class="form">

    <?php $form=$this->beginWidget('\TbActiveForm', array(
	    'id'=>'item-size-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
	    'enableAjaxValidation'=>false,

)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php //echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'name',array('span'=>5,'maxlength'=>2)); ?>

            <?php echo $form->textFieldControlGroup($model,'full_name',array('span'=>5,'maxlength'=>30)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->