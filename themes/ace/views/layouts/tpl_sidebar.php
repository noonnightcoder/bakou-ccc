<!--
<div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
        <?php //echo TbHtml::linkButton('', array('url'=>Yii::app()->urlManager->createUrl('settings/index'),'color' => TbHtml::BUTTON_COLOR_DANGER,'icon'=>'ace-icon fa fa-cog','size'=> TbHtml::BUTTON_SIZE_SMALL)); ?>
        <?php //echo TbHtml::linkButton('', array('url'=>Yii::app()->urlManager->createUrl('client/admin'),'color' => TbHtml::BUTTON_COLOR_WARNING,'icon'=>'ace-icon fa fa-group','size'=> TbHtml::BUTTON_SIZE_SMALL)); ?>
        <?php //echo TbHtml::linkButton('', array('url'=>Yii::app()->urlManager->createUrl('report/SaleReportTab'),'color' => TbHtml::BUTTON_COLOR_SUCCESS,'icon'=>'ace-icon fa fa-signal','size'=> TbHtml::BUTTON_SIZE_SMALL)); ?>
        <?php //echo TbHtml::linkButton('', array('url'=>Yii::app()->urlManager->createUrl('report/SaleInvoice'),'color' => TbHtml::BUTTON_COLOR_INFO,'icon'=>'ace-icon fa fa-pencil','size'=> TbHtml::BUTTON_SIZE_SMALL)); ?>
    </div>
    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
    </div>
</div><!--#sidebar-shortcuts-->
<?php 
$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'submenuHtmlOptions'=>array('class'=>'submenu'),
    'encodeLabel' => false,
    'items' => array(
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('app', 'Dashboard')) . '</span>', 'icon'=>'menu-icon fa fa-tachometer', 'url'=>Yii::app()->urlManager->createUrl('dashboard/view'), 'active'=>$this->id .'/'. $this->action->id=='dashboard/view'?true:false,
                    'visible'=> Yii::app()->user->checkAccess('report.index')
            ),
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('app', 'Item')) . '</span>', 'icon'=>'menu-icon fa fa-qrcode', 'url'=>Yii::app()->urlManager->createUrl('item/admin'), 'active'=> $this->id == 'item' ,
                'visible'=> Yii::app()->user->checkAccess('item.index') || Yii::app()->user->checkAccess('item.create') || Yii::app()->user->checkAccess('item.update') || Yii::app()->user->checkAccess('item.delete')
            ),
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('app', 'Barcode Detector')). '</span>', 'icon'=>'menu-icon fa fa-magic', 'url'=>Yii::app()->urlManager->createUrl('barcodeReader/index'), 'active'=>$this->id .'/'. $this->action->id=='barcodeReader/index',
                'visible'=> Yii::app()->user->checkAccess('scan.index')
            ),
            /*array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('app', 'Color Controller')). '</span>', 'icon'=>'menu-icon fa fa-magic', 'url'=>Yii::app()->urlManager->createUrl('colorReader/index'), 'active'=>$this->id .'/'. $this->action->id=='colorReader/index',
                 //'visible'=> Yii::app()->user->checkAccess('sale.edit') || Yii::app()->user->checkAccess('sale.discount') || Yii::app()->user->checkAccess('sale.editprice')
            ),*/
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('app', 'Report')) .'</span>', 'icon'=>'menu-icon fa fa-signal', 'url'=>Yii::app()->urlManager->createUrl('report/DailyScan'),
                'active'=>$this->id =='report',
                'visible'=> Yii::app()->user->checkAccess('report.index'),
                'items'=>array(
                    array('label'=> Yii::t('app','Daily Scan'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/DailyScan'),
                        'active'=>$this->id .'/'. $this->action->id =='report/DailyScan',
                        'visible'=> Yii::app()->user->checkAccess('report.index')
                    ),
                    array('label'=> Yii::t('app','Scan By PO No'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/DailyScanByItemNo'),
                        'active'=>$this->id .'/'. $this->action->id =='report/DailyScanByItemNo',
                        'visible'=> Yii::app()->user->checkAccess('report.index')
                    ),
                    array('label'=> Yii::t('app','Detail Scan'),'icon'=> 'menu-icon fa fa-caret-right', 'url'=>Yii::app()->urlManager->createUrl('report/DetailScan'),
                        'active'=>$this->id .'/'. $this->action->id =='report/DetailScan',
                        'visible'=> Yii::app()->user->checkAccess('report.index')
                    ),
            )),
            array('label'=>'<span class="menu-text">'. strtoupper(Yii::t('menu','Settings')) . '</span>', 'icon'=>'menu-icon fa fa-cogs','url'=>Yii::app()->urlManager->createUrl('settings/index'),
                           'active'=>$this->id=='itemColor' || $this->id=='itemSize' || $this->id=='store' || $this->id=='settings' || $this->id=='employee',
                           'visible'=> Yii::app()->user->checkAccess('setting.system') ||  Yii::app()->user->checkAccess('size.index') || Yii::app()->user->checkAccess('color.index'),
                           'items'=>array(
                               array('label'=>Yii::t('app', 'Size'), 'icon'=> TbHtml::ICON_LIST, 'url'=>Yii::app()->urlManager->createUrl('itemSize/admin'),
                                    'active'=>$this->id =='itemSize',
                                    'visible'=> Yii::app()->user->checkAccess('size.index') || Yii::app()->user->checkAccess('size.create') || Yii::app()->user->checkAccess('size.update') || Yii::app()->user->checkAccess('size.delete')
                                    ),
                               array('label'=>Yii::t('app','Color'),'icon'=> TbHtml::ICON_ADJUST, 'url'=>Yii::app()->urlManager->createUrl('itemColor/admin'),
                                   'active'=>$this->id =='itemColor',
                                   'visible'=> Yii::app()->user->checkAccess('color.index') || Yii::app()->user->checkAccess('color.create') || Yii::app()->user->checkAccess('color.update') || Yii::app()->user->checkAccess('color.delete')
                               ),
                               array('label'=>Yii::t('menu', 'Employee'), 'icon'=> TbHtml::ICON_USER, 'url'=>Yii::app()->urlManager->createUrl('employee/admin'), 'active'=>$this->id =='employee',
                                   'visible'=> Yii::app()->user->checkAccess('employee.index') || Yii::app()->user->checkAccess('employee.create') || Yii::app()->user->checkAccess('employee.update') || Yii::app()->user->checkAccess('employee.delete')
                               ),
                               array('label'=>Yii::t('app','Shop Setting'),'icon'=> TbHtml::ICON_COG, 'url'=>Yii::app()->urlManager->createUrl('settings/index'),
                                   'active'=>$this->id=='settings',
                                  //'visible'=> Yii::app()->user->isAdmin
                               ),
            )),
            array('label'=>'<span class="menu-text">' . strtoupper(Yii::t('menu', 'About US')) . '</span>', 'icon'=>'menu-icon fa fa-info-circle', 'url'=>Yii::app()->urlManager->createUrl('site/about'), 'active'=>$this->id .'/'. $this->action->id=='site/about'),
    ), 
)); 
?>

<!-- #section:basics/sidebar.layout.minimize -->
<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>

<!-- /section:basics/sidebar.layout.minimize -->
<script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
</script>