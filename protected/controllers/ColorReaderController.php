<?php

class ColorReaderController extends Controller
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
				'actions'=>array('index','setColor','Add'),
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

    public function actionSetColor($id)
    {
        if (Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {
            Yii::app()->coloringCart->setColorId($id);
            $this->reload();
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionAdd()
    {

        $data=$this->sessionInfo();
        $data['id'] = $_POST['ColorCode']['id'];

        if (!$data['color_id']) {
            //$data['warning'] = Yii::t('app','Plz, select at least a Color Code');
            Yii::app()->user->setFlash('warning', "Plz! select at least a Color Code to start your day.");
        } else {
            ColorReader::model()->saveColorReader($data['id'],$data['color_id'],$data['employee_id']);

            if ($data['id'] !== $data['color_id']) {
                $data['alert'] = 'danger';
                Yii::app()->user->setFlash('danger', "Oh snap! Change a few things up and try submitting again.");
            } else {
                $data['alert'] = 'success';
                Yii::app()->user->setFlash('success', "Well done! You successfully read this important alert message.");
            }
        }

        $this->reload($data);
    }

    private function reload($data=array())
    {
        $this->layout = '//layouts/column_sale';

        $data=$this->sessionInfo($data);

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
        $model = new ColorCode;

        $data['model'] = $model;
        $data['employee_id'] = Yii::app()->session['employeeid'];
        $data['color_codes'] = ColorCode::model()->getColorCode();
        $data['color_id'] = Yii::app()->coloringCart->getColorId();

        return $data;
    }

}