<?php

class ItemColorController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','restore','admin','initColor','colorOption'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		if (Yii::app()->request->isAjaxRequest) {

			Yii::app()->clientScript->scriptMap['*.js'] = false;

			echo CJSON::encode(array(
				'status' => 'render',
				'div' => $this->renderPartial('view', array('model' => $this->loadModel($id)), true, false),
			));

			Yii::app()->end();
		} else {
			$this->render('view',array(
				'model'=>$this->loadModel($id),
			));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if (!Yii::app()->user->checkAccess('color.create')) {
			$this->redirect(array('site/ErrorException','err_no'=>403));
		}

		$model=new ItemColor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['ItemColor'])) {
			$model->attributes=$_POST['ItemColor'];
			if ($model->save()) {
				Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,Yii::t('app','Item Color').  ' : <strong>' . $model->name . '</strong> successfully saved!' );
				$this->redirect(array('create'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		if (!Yii::app()->user->checkAccess('color.update')) {
			$this->redirect(array('site/ErrorException','err_no'=>403));
		}

		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['ItemColor'])) {
			$model->attributes=$_POST['ItemColor'];
			if ($model->save()) {
				Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,Yii::t('app','Item Color').  ' : <strong>' . $model->name . '</strong> successfully saved!' );
				$this->redirect(array('admin'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (!Yii::app()->user->checkAccess('color.delete')) {
			$this->redirect(array('site/ErrorException','err_no'=>403));
		}

		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			ItemColor::model()->deleteItemColor($id);

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	public function actionRestore($id)
	{
		if (Yii::app()->request->isPostRequest) {
			ItemColor::model()->restoreItemColor($id);

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ItemColor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ItemColor('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ItemColor'])) {
			$model->attributes=$_GET['ItemColor'];
		}

		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSizeItemColor',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}

		if (isset($_GET['archived'])) {
			Yii::app()->user->setState('archivedItemColor',$_GET['archived']);
			unset($_GET['archived']);
		}

		$model->archived = Yii::app()->user->getState('archivedItemColor', Yii::app()->params['defaultArchived'] );

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ItemColor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ItemColor::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ItemColor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='item-color-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionColorOption()
	{
		if (isset($_GET['term'])) {
			$term = trim($_GET['term']);
			$ret['results'] = ItemColor::colorByName($term);
			echo CJSON::encode($ret);
			Yii::app()->end();

		}
	}

	public function actionInitColor()
	{
		$model = ItemColor::model()->find('CONVERT(id,CHAR(3))=:id', array(':id' => $_GET['id']));
		if ($model !== null) {
			echo CJSON::encode(array('id' => $model->id, 'text' => $model->name));
		}
	}
}