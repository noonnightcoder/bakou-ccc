<?php

class ItemController extends Controller
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
				'actions'=>array('create','update','admin','delete','restore','Recount'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','Recount'),
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
		if (!Yii::app()->user->checkAccess('item.create')) {
			$this->redirect(array('site/ErrorException','err_no'=>403));
		}

		$model=new Item;
		$validation_class = '';

        if (isset($_POST['Item'])) {
            $model->attributes = $_POST['Item'];

            $size_name = $_POST['Item']['size_id'];
            $color_name = $_POST['Item']['color_id'];

            //Saving new category to `category` table
            $item_size_id = ItemSize::model()->saveItemSize($size_name);
            $item_color_id = ItemColor::model()->saveItemColor($color_name);

			if ($item_size_id !== null) {
                $model->size_id = $item_size_id;
            }

            if ($item_color_id !== null) {
                $model->color_id = $item_color_id;
            }


            $rnd = rand(0,9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model,'image');
            $fileName = "{$rnd}_{$uploadedFile}";  // random number + file name
            $model->image = $fileName;

            if ($model->validate()) {
                if ($model->save()) {
                    if($uploadedFile !== null) {
                        $uploadedFile->saveAs(Yii::app()->basePath . '/../ximages/' . $fileName);
                    }
                    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,Yii::t('app','Item').  ' : <strong>' . $model->name . '</strong> successfully saved!' );
                    $this->redirect(array('create'));
                }
            } else {
				$validation_class = 'has-error';
			}
        }

		$this->render('create', array(
			'model' => $model,
			'validation_class' => $validation_class,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if (!Yii::app()->user->checkAccess('item.update')) {
			$this->redirect(array('site/ErrorException','err_no'=>403));
		}

		$model=$this->loadModel($id);
		$validation_class = '';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Item'])) {
			$model->attributes = $_POST['Item'];

            $rnd = rand(0,9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model,'image');

            if (!isset($model->image)) {
                $fileName = "{$rnd}_{$uploadedFile}";  // random number + file name
                $model->image = $fileName;
            }

			$size_name = $_POST['Item']['size_id'];
			$color_name = $_POST['Item']['color_id'];

			//Saving new category to `category` table
			$item_size_id = ItemSize::model()->saveItemSize($size_name);
			$item_color_id = ItemColor::model()->saveItemColor($color_name);

			if ($item_size_id !== null) {
				$model->size_id = $item_size_id;
			}

			if ($item_color_id !== null) {
				$model->color_id = $item_color_id;
			}

			if ($model->validate()) {
				$transaction = Yii::app()->db->beginTransaction();
				try {
					if ($model->save()) {
                        if($uploadedFile !== null) {
                            $uploadedFile->saveAs( Yii::app()->basePath . '/../ximages/' . $model->image);
                        }
						$transaction->commit();
						Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS,Yii::t('app','Item').  ' : <strong>' . $model->name . '</strong> successfully saved!' );
						$this->redirect(array('admin'));
					}
				} catch (Exception $e) {
					$transaction->rollback();
					Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_WARNING, 'Oop something wrong : <strong>' . $e);
				}
			} else {
				$validation_class = 'has-error';
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'validation_class' => $validation_class,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{

		if (!Yii::app()->user->checkAccess('item.delete')) {
			throw new CHttpException(403, 'You are not authorized to perform this action');
		}

		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			//$this->loadModel($id)->delete();
			Item::model()->deleteItem($id);

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionRestore($id)
	{
		if (Yii::app()->request->isPostRequest) {
			Item::model()->restoreItem($id);

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
		$dataProvider=new CActiveDataProvider('Item');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Item('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Item'])) {
			$model->attributes=$_GET['Item'];
		}

		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}

		if (isset($_GET['archived'])) {
			Yii::app()->user->setState('archived',$_GET['archived']);
			unset($_GET['archived']);
		}

		$model->archived = Yii::app()->user->getState('archived', Yii::app()->params['defaultArchived'] );

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Item the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Item::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Item $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='item-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionRecount($id)
	{
		if (Yii::app()->request->isPostRequest && Yii::app()->request->isAjaxRequest ) {

			TransactionLog::model()->transactionAchieve($id, Yii::app()->session['employeeid']);
			Yii::app()->user->setFlash('success', "Successfully start re-count product(s) from zero");

		} else {
			Yii::app()->user->setFlash('danger', "Invalid request. Please do not repeat this request again.");
		}

		Yii::app()->clientScript->scriptMap['*.js'] = false;
		$this->renderPartial('//layouts/partial/_flash_message');
	}


	public function gridCorrectScan($data, $row)
	{
		echo TransactionLog::model()->countTotalTran($data->id,'Correct');
	}

	public function gridIncorrectScan($data, $row)
	{
		echo TransactionLog::model()->countTotalTran($data->id,'Incorrect');
	}



}