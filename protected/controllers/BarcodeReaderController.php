<?php

class BarcodeReaderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(''),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('home','scanSample','resetSample','index','setColor','Add','CancelScan','RestoreScan'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionIndex()
    {
        $this->reload();
    }

    public function actionScanSample()
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            $id = $_POST['Item']['id'];
            if (!Yii::app()->barcodeReaderCart->setSampleItem($id)) {
                Yii::app()->user->setFlash('danger', "Product was not found in the system");
            }
        } else {
            Yii::app()->user->setFlash('danger', "Invalid request. Please do not repeat this request again.");
        }

        $this->reload();
    }

    public function actionResetSample()
    {
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            Yii::app()->barcodeReaderCart->clearSampleItem();
        } else {
            //throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            Yii::app()->user->setFlash('danger', "Invalid request. Please do not repeat this request again.");
        }

        $this->reload();
    }

    public function actionAdd()
    {

        $data=$this->sessionInfo();

        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
			$item_id = $_POST['Item']['id'];
			$items = Item::model()->getItemById($item_id);
			if (empty($items)) {
				$items = Item::model()->getItemByBarcode($item_id);
			}
			
			if (empty($items)) {
				$data['alert_type'] = 'item_not_found';
				Yii::app()->user->setFlash('danger','Product was not found in the system');
			} else {
			
				foreach ($items as $item) {
					$data['item_id'] =  $item["item_id"];
				}

				if (!isset($data['sample_items'])) {
					Yii::app()->user->setFlash('warning', "Plz! select at least a Color Code to start your day.");
				} else {

					//ColorReader::model()->saveColorReader($data['id'],$data['color_id'],$data['employee_id']);
					TransactionLog::model()->saveTransactionLog($data['item_id'],$data['sample_id'],$data['employee_id']);

					if ($data['item_id'] !== $data['sample_id']) {
						$data['alert_type'] = 'item_not_correct';
						$data['alert'] = 'danger';
						Yii::app()->user->setFlash('danger', "Product entered is not correct");
					} else {
						$data['alert_type'] = 'success';
						$data['alert'] = 'success';
						Yii::app()->user->setFlash('success',
							"Well done! Product entered is correct");
					}
				}
			}	
        } else {
            Yii::app()->user->setFlash('danger', "Invalid request. Please do not repeat this request again.");
        }

        $this->reload($data);
    }

    public function actionCancelScan($id)
    {

        $data = $this->sessionInfo();
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            TransactionLog::model()->cancelTransaction($id,$data['employee_id']);
        } else {
            Yii::app()->user->setFlash('danger', "Invalid request. Please do not repeat this request again.");
        }

        $this->reload($data);
    }

    public function actionRestoreScan($id)
    {
        $data = $this->sessionInfo();
        if ( Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            TransactionLog::model()->restoreTransaction($id, $data['employee_id']);
        } else {
            Yii::app()->user->setFlash('danger', "Invalid request. Please do not repeat this request again.");
        }
        $this->reload($data);
    }

    private function reload($data=array())
    {
        $this->layout = '//layouts/column_sale';

        $data = $this->sessionInfo($data);

        if (Yii::app()->request->isAjaxRequest) {

            $cs = Yii::app()->clientScript;
            $cs->scriptMap = array(
                'jquery.js' => false,
                'bootstrap.js' => false,
                'jquery.min.js' => false,
                'bootstrap.notify.js' => false,
                'bootstrap.bootbox.min.js' => false,
                'bootstrap.min.js' => false,
                'jquery-ui.min.js' => false,
                //'EModalDlg.js'=>false,
            );

            Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false;
            Yii::app()->clientScript->scriptMap['box.css'] = false;
            $this->renderPartial('index', $data, false, true);
        } else {
            $this->render('index', $data);
        }
    }

    protected function sessionInfo($data=array())
    {
        $model = new Item;
        $transaction_log = new TransactionLog;
        $data['alert'] = isset($data['alert']) ? $data['alert'] : null;
		$data['alert_type'] = isset($data['alert_type']) ? $data['alert_type'] : null;
        $data['sample_id']=0;

        $data['model'] = $model;
        $data['transaction_log'] = $transaction_log;
        $data['employee_id'] = Yii::app()->session['employeeid'];
        $data['sample_items'] = Yii::app()->barcodeReaderCart->getSampleItem();

        if (isset($data['sample_items'])) {
            foreach ($data['sample_items'] as $sample_item ) {
                $data['sample_id'] = $sample_item['item_id'];
                $data['sample_name'] = $sample_item['name'];
                $data['sample_size'] = $sample_item['size'];
                $data['sample_color'] = $sample_item['color_name'];
            }
        }

        $data['grid_id'] = 'detail-scan-grid';
        $data['data_provider'] = $transaction_log->detailGridScan($data['sample_id']);
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
                'header' => Yii::t('app', 'Timer'),
                'value' => 'Common::timeAgo($data["create_at"])',
            ),
            array(
                'name' => 'item_number',
                'header' => Yii::t('app', 'P0 Number'),
                'value' => '$data["item_number"]',
            ),
            /*
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
            */
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
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'header' => Yii::t('app', 'Action'),
                'template'=>'<div class="hidden-sm hidden-xs btn-group">{cancel}{restore}</div>',
                'htmlOptions'=>array('class'=>'hidden-sm hidden-xs btn-group'),
                'buttons' => array(
                    'cancel' => array(
                        'url'=>'Yii::app()->createUrl("BarcodeReader/CancelScan", array("id"=>$data["id"]))',
                        'label' => Yii::t('app', 'Cancel Scan'),
                        'icon'=>'bigger-120 glyphicon-trash',
                        'options' => array(
                            'title' => 'Cancel Scan',
                            'class' => 'btn btn-xs btn-danger btn-cancel',
                        ),
                        'visible' => '$data["status"]=="1"',
                    ),
                    'restore' => array(
                        'url'=>'Yii::app()->createUrl("BarcodeReader/RestoreScan", array("id"=>$data["id"]))',
                        'label' => Yii::t('app', 'Restore'),
                        'icon' => 'bigger-120 glyphicon-refresh',
                        'options' => array(
                            'class' => 'btn btn-xs btn-warning btn-restore',
                        ),
                        'visible' => '$data["status"]=="0"',
                    ),
                ),
            ),
        );


        $data['trans_status_all'] = TransactionLog::model()->countTranAll($data['sample_id']);
        $data['trans_status_today'] = TransactionLog::model()->countTranByStatus($data['sample_id'],0);
        $data['trans_status_yesterday'] = TransactionLog::model()->countTranByStatus($data['sample_id'],1);


        return $data;
    }

}