<?php
class ReportController extends Controller
{
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'DailyScan',
                    'DailyScanByItemNo',
                    'DetailScan',
                ),
                'users' => array('@'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionDailyScan()
    {

        $report = new Report;

        if (isset($_GET['Report'])) {
            $from_date = $_GET['Report']['from_date'];;
            $to_date = $_GET['Report']['to_date'];;
        } else {
            $from_date = date('d-m-Y');
            $to_date = date('d-m-Y');
        }

        $data['report'] = $report;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['grid_id'] = 'daily-scan-grid';
        $data['title'] = 'Daily Scan';

        $data['grid_columns'] = array(
            array('name'=>'date_report',
                'header'=>Yii::t('app','Date'),
                'value'=>'$data["date_report"]',
            ),
            array('name'=>'Correct',
                'header'=>Yii::t('app','Correct'),
                'htmlOptions'=>array('style' => 'text-align: right;'),
                'headerHtmlOptions'=>array('style' => 'text-align: right;'),
                'value' =>'$data["Correct"]',
            ),
            array('name'=>'Incorrect',
                'header'=>Yii::t('app','Incorrect'),
                'htmlOptions'=>array('style' => 'text-align: right;'),
                'headerHtmlOptions'=>array('style' => 'text-align: right;'),
                'value' =>'$data["Incorrect"]',
            ),
            array('name'=>'Total',
                'header'=>Yii::t('app','Total'),
                'htmlOptions'=>array('style' => 'text-align: right;'),
                'headerHtmlOptions'=>array('style' => 'text-align: right;'),
                'value' =>'$data["Total"]',
            ),
        );


        $report->from_date = $from_date;
        $report->to_date = $to_date;
        $data['data_provider'] = $report->dailyScan();

        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['*.css'] = false;
            Yii::app()->clientScript->scriptMap['*.js'] = false;
            echo CJSON::encode(array(
                'status' => 'success',
                'div' => $this->renderPartial('partial/_grid', $data, true, false),
            ));
        }else {
            $this->render('main',$data);
        }

    }

    public function actionDailyScanByItemNo()
    {

        $report = new Report;

        if (isset($_GET['Report'])) {
            $from_date = $_GET['Report']['from_date'];;
            $to_date = $_GET['Report']['to_date'];;
        } else {
            $from_date = date('d-m-Y');
            $to_date = date('d-m-Y');
        }

        $data['report'] = $report;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['grid_id'] = 'daily-scan-by-item-no-grid';
        $data['title'] = Yii::t('app','Scan By PO No');


        $data['grid_columns'] =  array(
            array('name'=>'date_report',
                'header'=>Yii::t('app','Date'),
                'value'=>'$data["date_report"]',
            ),
            array('name'=>'item_number',
                'header'=>Yii::t('app','P0 Number'),
                'value'=>'$data["item_number"]',
            ),
            array('name'=>'Correct',
                'header'=>Yii::t('app','Correct'),
                'htmlOptions'=>array('style' => 'text-align: right;'),
                'headerHtmlOptions'=>array('style' => 'text-align: right;'),
                'value' =>'$data["Correct"]',
            ),
            array('name'=>'Incorrect',
                'header'=>Yii::t('app','Incorrect'),
                'htmlOptions'=>array('style' => 'text-align: right;'),
                'headerHtmlOptions'=>array('style' => 'text-align: right;'),
                'value' =>'$data["Incorrect"]',
            ),
            array('name'=>'Total',
                'header'=>Yii::t('app','Total'),
                'htmlOptions'=>array('style' => 'text-align: right;'),
                'headerHtmlOptions'=>array('style' => 'text-align: right;'),
                'value' =>'$data["Total"]',
            ),
        );

        $report->from_date = $from_date;
        $report->to_date = $to_date;

        $data['data_provider'] = $report->dailyScanByItemNo();

        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['*.css'] = false;
            Yii::app()->clientScript->scriptMap['*.js'] = false;
            echo CJSON::encode(array(
                'status' => 'success',
                'div' => $this->renderPartial('partial/_grid', $data, true, false),
            ));
        }else {
            $this->render('main',$data);
        }

    }

    public function actionDetailScan()
    {

        $report = new Report;

        if (isset($_GET['Report'])) {
            $from_date = $_GET['Report']['from_date'];;
            $to_date = $_GET['Report']['to_date'];;
        } else {
            $from_date = date('d-m-Y');
            $to_date = date('d-m-Y');
        }

        $data['report'] = $report;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['grid_id'] = 'detail-scan';
        $data['title'] = Yii::t('app','Detail Scan');


        $data['grid_columns'] = array(
            array(
                'name' => 'date_report',
                'header' => Yii::t('app', 'Date'),
                'value' => '$data["date_report"]',
            ),
            array(
                'name' => 'times',
                'header' => Yii::t('app', 'Time'),
                'value' => '$data["times"]',
            ),
            array(
                'name' => 'item_number',
                'header' => Yii::t('app', 'P0 Number'),
                'value' => '$data["item_number"]',
            ),
            array(
                'name' => 'size_name',
                'header' => Yii::t('app', 'Size'),
                'value' => '$data["size_name"]',
            ),
            array(
                'name' => 'color_name',
                'header' => Yii::t('app', 'Color'),
                'value' => '$data["color_name"]',
            ),
            array(
                'name' => 'scanner',
                'header' => Yii::t('app', 'Scanner'),
                'value' => '$data["scanner"]',
            ),
            array(
                'name' => 'scan_status',
                'header' => Yii::t('app', 'Scan Result'),
                'value' =>  'Yii::t("app",$data["scan_status"])',
            ),
        );

        $report->from_date = $from_date;
        $report->to_date = $to_date;

        $data['data_provider'] = $report->detailScan();

        if (Yii::app()->request->isAjaxRequest) {

            Yii::app()->clientScript->scriptMap['*.css'] = false;
            Yii::app()->clientScript->scriptMap['*.js'] = false;

            echo CJSON::encode(array(
                'status' => 'success',
                'div' => $this->renderPartial('partial/_grid', $data, true, false),
            ));

        }else {
            $this->render('main',$data);
        }

    }
}