<div class="row">
        <?php $this->widget('bootstrap.widgets.TbAlert', array(
                'block'=>true, // display a larger alert block?
                'fade'=>true, // use transitions?
                'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
                'alerts'=>array( // configurations per alert type
                    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), 
                    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
                ),
        )); ?>

        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                'id'=>'employee-form',
                'enableAjaxValidation'=>false,
                'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
        )); ?>

        <div class="col-sm-5">
            <h4 class="header blue"><i class="ace-icon fa fa-info-circle blue"></i><?php echo Yii::t('app','Employee Basic Information') ?></h4>
                <p class="help-block"><?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?></p>

                <?php //echo $form->errorSummary($model); ?>

                <?php echo $form->textFieldControlGroup($model,'first_name',array('class'=>'span10','maxlength'=>50,'data-required'=>'true')); ?>

                <?php echo $form->textFieldControlGroup($model,'last_name',array('class'=>'span10','maxlength'=>50,'data-required'=>'true')); ?>

                <?php echo $form->textFieldControlGroup($model,'mobile_no',array('class'=>'span10','maxlength'=>15)); ?>

                <div class="form-group">

                    <label class="col-sm-3 control-label" for="Employee_dob"><?php echo Yii::t('app','Date of Birth') ?></label>

                    <div class="col-sm-9">

                        <?php echo CHtml::activeDropDownList($model, 'day', Employee::itemAlias('day'), array('prompt' => yii::t('app','Day'))); ?>

                        <?php echo CHtml::activeDropDownList($model, 'month', Employee::itemAlias('month'), array('prompt' => yii::t('app','Month'))); ?>

                        <?php echo CHtml::activeDropDownList($model, 'year', Employee::itemAlias('year'), array('prompt' => yii::t('app','Year'))); ?>

                        <span class="help-block"> <?php echo $form->error($model,'dob'); ?> </span>
                    </div>

                </div>

                <?php echo $form->textFieldControlGroup($model,'adddress1',array('class'=>'span10','maxlength'=>60)); ?>

                <?php echo $form->textFieldControlGroup($model,'address2',array('class'=>'span10','maxlength'=>60)); ?>

                <?php //echo $form->textFieldControlGroup($model,'city_id',array('class'=>'span10')); ?>

                <?php echo $form->textFieldControlGroup($model,'country_code',array('class'=>'span10','maxlength'=>2)); ?>

                <?php echo $form->textFieldControlGroup($model,'email',array('class'=>'span10','maxlength'=>30,'data-type'=>'email')); ?>

                <?php echo $form->textAreaControlGroup($model,'notes',array('rows'=>2, 'cols'=>20, 'class'=>'span10')); ?>
        </div>

        <div class="col-sm-7">
                <h4 class="header blue bolder smaller"><i class="ace-icon fa fa-key blue"></i><?php echo Yii::t('app','Employee Login Info') ?></h4>
                
                <?php echo $form->textFieldControlGroup($user,'user_name',array('class'=>'span8','maxlength'=>60,'placeholder'=>'User name', 'autocomplete'=>'off','data-required'=>'true','disabled' => $disabled)); ?>

                <?php if ($model->isNewRecord) { ?>

                <?php echo $form->passwordFieldControlGroup($user,'Password',array('class'=>'span8','maxlength'=>128,'placeholder'=>'User Password','autocomplete'=>'off')); ?>

                <?php echo $form->passwordFieldControlGroup($user,'PasswordConfirm',array('class'=>'span8','maxlength'=>128, 'placeholder'=>'Password Confirm','autocomplete'=>'off')); ?>

                <?php //echo $form->dropDownListControlGroup($model, 'location', Location::model()->getLocationChk(),array('class'=>'ace-checkbox-2')); ?>
                
                <?php } elseif (Yii::app()->user->isAdmin) { ?>
                      <?php echo $form->passwordFieldControlGroup($user,'ResetPassword',array('class'=>'span8','maxlength'=>128,'placeholder'=>'User Password','autocomplete'=>'off')); ?>
                <?php } ?>
                
                    <?php //if ($n_location>1) { ?> 
                    <?php //echo $form->inlineCheckBoxListControlGroup($model, 'visit_location', Location::model()->getLocationChk(),array('class'=>'ace-checkbox-2')); ?>
                    <?php //} ?>
                
                <?php //echo $form->textFieldControlGroup($user,'employee_id',array('class'=>'span5')); ?>
                <h4 class="header blue bolder"><i class="ace-icon fa fa-gavel blue"></i><?php echo Yii::t('app','Employee Permissions and Access'); ?></h4>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="RbacUser_items"><?php echo Yii::t('app','Item'); ?></label>
                    <div class="col-sm-9">
                        <?php echo CHtml::activeCheckboxList($user, 'items',Authitem::model()->getAuthItemItem(), array('separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','checkAll' => Yii::t('app','Select All'))); ?>
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="RbacUser_sales"><?php echo Yii::t('app','Barcode Detector'); ?></label>
                    <div class="col-sm-9">
                        <?php echo CHtml::activeCheckboxList($user, 'barcode',Authitem::model()->getAuthItemItem('scan'), array('separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','checkAll' => Yii::t('app','Select All'))); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="RbacUser_sizes"><?php echo Yii::t('app','Size'); ?></label>
                    <div class="col-sm-9">
                        <?php echo CHtml::activeCheckboxList($user, 'sizes',Authitem::model()->getAuthItemItem('size'), array('separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','checkAll' => Yii::t('app','Select All'))); ?>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-3 control-label" for="RbacUser_colors"><?php echo Yii::t('app','Color'); ?></label>
                    <div class="col-sm-9">
                        <?php echo CHtml::activeCheckboxList($user, 'colors',Authitem::model()->getAuthItemItem('color'), array('separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','checkAll' => Yii::t('app','Select All'))); ?>
                    </div>
                </div>
                  
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="RbacUser_employees"><?php echo Yii::t('app','Employee'); ?></label>
                    <div class="col-sm-9">
                        <?php echo CHtml::activeCheckboxList($user, 'employees',Authitem::model()->getAuthItemItem('employee'), array('separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','checkAll' => Yii::t('app','Select All'))); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="RbacUser_reports"><?php echo Yii::t('app','Report'); ?></label>
                    <div class="col-sm-9">
                        <?php echo CHtml::activeCheckboxList($user, 'reports',Authitem::model()->getAuthItemItem('report'), array('separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','checkAll' => Yii::t('app','Select All'))); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="RbacUser_store"><?php echo Yii::t('app','Store'); ?></label>
                    <div class="col-sm-9">
                        <?php echo CHtml::activeCheckboxList($user, 'store',Authitem::model()->getAuthItemItem('setting'), array('separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','checkAll' => Yii::t('app','Select All'))); ?>
                    </div>
                </div>

            <div class="form-actions">
                <?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array(
                   'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                   //'size'=>TbHtml::BUTTON_SIZE_SMALL,
               )); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
</div>

<?php Yii::app()->clientScript->registerScript('setFocus',  '$("#Employee_first_name").focus();'); ?>
