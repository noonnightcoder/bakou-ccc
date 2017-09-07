<?php
$this->breadcrumbs=array(
	Yii::t('app','Dashboard'),
);
?>

<?php
$date = array();
$correct = array();
$incorrect = array();
$total = array();
foreach ($report->dailyScanChart() as $record) {
    $date[] = $record["date_report"];
    $correct[] = floatval($record['Correct']);
    $incorrect[] = floatval($record["Incorrect"]);
    $total[] = floatval($record["Total"]);
}

?>

<div class="col-xs-12 widget-container-col summary_header">

    <?php foreach($report->countTransaction() as $record) { ?>
        <?php
        $stat_css = $record['diff_percent'] > 0 ?  'stat-success' : 'stat-important';
        $infobox_css = $record['diff_percent'] > 0 ?  'infobox-green' : 'infobox-red';
        ?>
        <div class="infobox <?= $infobox_css; ?>">
            <div class="infobox-data">
                <span class="infobox-data-number"><?= number_format($record['amount'], Common::getDecimalPlace()); ?></span>
                <div class="infobox-content"><?= CHtml::link(Yii::t('app','Today vs Last') . ' '   . date('l'), Yii::app()->createUrl("report/SaleReportTab")); ?></div>
            </div>
            <div class="stat <?= $stat_css; ?>">
                <?= $record['diff_percent']; ?> %
            </div>
        </div>
    <?php } ?>

    <?php foreach($report->countTransaction(1) as $record) { ?>
        <?php
        $stat_css = $record['diff_percent'] > 0 ?  'stat-success' : 'stat-important';
        $infobox_css = $record['diff_percent'] > 0 ?  'infobox-green' : 'infobox-red';
        ?>
        <div class="infobox <?= $infobox_css; ?>">
            <div class="infobox-data">
                <span class="infobox-data-number"><?= number_format($record['amount'], Common::getDecimalPlace()); ?></span>
                <div class="infobox-content"><?= CHtml::link(Yii::t('app','Yesterday vs Last') . ' '  . date('l',time() - 60 * 60 * 24), Yii::app()->createUrl("report/SaleReportTab")); ?></div>
            </div>
            <div class="stat <?= $stat_css; ?>">
                <?= $record['diff_percent']; ?> %
            </div>
        </div>
    <?php } ?>

    <?php foreach($report->monthlyTransaction(1) as $record) { ?>
        <?php
        $stat_css = $record['diff_percent'] > 0 ?  'stat-success' : 'stat-important';
        $infobox_css = $record['diff_percent'] > 0 ?  'infobox-green' : 'infobox-red';
        ?>
        <div class="infobox <?= $infobox_css; ?>">
            <div class="infobox-data">
                <span class="infobox-data-number"><?= number_format($record['amount'], Common::getDecimalPlace()); ?></span>
                <div class="infobox-content"><?= CHtml::link(date('F') . ' vs ' . date('F', time() - 30*3600*24), Yii::app()->createUrl("report/SaleReportTab")); ?></div>
            </div>
            <div class="stat <?= $stat_css; ?>">
                <?= $record['diff_percent']; ?> %
            </div>
        </div>
    <?php } ?>

</div>

<div class="col-xs-12 widget-container-col char_section">
    <div class="widget-box widget-color-blue2">
        <div class="widget-header widget-header-flat">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-bar-chart-o"></i>
                <?php echo Yii::t('app','Daily Scan Chart'); ?>
            </h5>
            <div class="widget-toolbar">
                <a href="#" data-action="collapse">
                    <i class="ace-icon fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="widget-body">
            <?php
            $this->widget(
                'yiiwheels.widgets.highcharts.WhHighCharts',
                array(
                    'pluginOptions' => array(
                        //'chart'=> array('type'=>'bar'),
                        'title' => array('text' => Yii::t('app', 'Daily Scan')),
                        'xAxis' => array(
                            'categories' => $date
                        ),
                        'yAxis' => array(
                            'title' => array('text' => '# of Scan')
                        ),
                        'series' => array(
                            array('name' => Yii::t('app','Total'), 'data' => $total),
                            array('name' => Yii::t('app','Correct'), 'data' => $correct),
                            array('name' => Yii::t('app','Incorrect'), 'data' => $incorrect),
                        )
                    )
                )
            );
            ?>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-6 widget-container-col">
    <div class="widget-box widget-color-blue2">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">
                <i class="ace-icon fa fa-trophy"></i>
                <?php echo Yii::t('app','This Year Top 10 Item ') . Yii::t('app','Ranked by # of Scan'); ?>
            </h5>
        </div>

        <div class="widget-body">
            <div class="widget-main no-padding">

                <?php $this->widget('yiiwheels.widgets.grid.WhGridView',array(
                    'id'=>'top-product-grid-qty',
                    'fixedHeader' => true,
                    'responsiveTable' => true,
                    'type'=>TbHtml::GRID_TYPE_BORDERED,
                    'dataProvider'=>$report->topProductByQty(),
                    //'summaryText' =>'<p class="text-info" align="left">' . Yii::t('app','This Year Top 10 Item ') . Yii::t('app','Ranked by Transaction') .'</p>',
                    'summaryText' => '',
                    'columns'=>array(
                        array('name'=>'rank',
                            'header'=>Yii::t('app','Rank'),
                            'value'=>'$data["rank"]',
                        ),
                        array('name'=>'item_name',
                            'header'=>Yii::t('app','Item Name'),
                            'value'=>'$data["item_name"]',
                        ),
                        array('name'=>'qty',
                            'header'=>Yii::t('app','#Scan'),
                            'value'=>'$data["qty"]',
                        ),
                    ),
                )); ?>

            </div>
        </div>
    </div>





