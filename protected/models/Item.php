<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property integer $id
 * @property string $barcode
 * @property string $item_number
 * @property integer $size_id
 * @property integer $color_id
 * @property string $name
 * @property string $name_jp
 * @property string $status
 * @property string $create_at
 * @property string $update_at
 * @property integer $create_by
 * @property integer $update_by
 *
 * The followings are the available model relations:
 * @property ItemColor $color
 * @property ItemSize $size
 */
class Item extends CActiveRecord
{

    public $archived;
	public $search;

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('barcode, item_number, size_id', 'required'),
			array('size_id, color_id, create_by, update_by', 'numerical', 'integerOnly'=>true),
			array('barcode', 'length', 'max'=>30),
			array('item_number', 'length', 'max'=>30),
			array('name, name_jp', 'length', 'max'=>60),
			array('image', 'length', 'max'=>200, 'on'=>'insert,update'),
			array('status', 'length', 'max'=>1),
			array('create_at,update_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
			array('update_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => false, 'on' => 'update'),
            array('image', 'file', 'allowEmpty' => true, 'maxSize' => 2024000, 'types' => 'jpg, jpeg, png'),
            //array('image', 'file', 'allowEmpty'=>false, 'types'=>'jpg, gif, png', 'on'=>'insert'),
           // array('image', 'file', 'allowEmpty'=>true, 'types'=>'jpg, gif, png', 'except'=>'insert', 'safe' => false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('barcode, item_number, size_id, color_id, name, name_jp, search, image', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'color' => array(self::BELONGS_TO, 'ItemColor', 'color_id'),
			'size' => array(self::BELONGS_TO, 'ItemSize', 'size_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'barcode' => Yii::t('app','Barcode'),
			'item_number' => Yii::t('app','Item Number'),
			'size_id' => Yii::t('app','Size'),
			'color_id' => Yii::t('app','Color'),
			'name' => Yii::t('app','Item Name'),
			'name_jp' => Yii::t('app','Name Japan'),
			'status' => 'Status',
			'create_at' => 'Create At',
			'update_at' => 'Update At',
			'create_by' => 'Create By',
			'update_by' => 'Update By',
			'scan_correct' => Yii::t('app','Scan Correct'),
			'scan_incorrect' => Yii::t('app','Scan Incorrect'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		/*$criteria->compare('id',$this->id);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('item_number',$this->item_number,true);
		$criteria->compare('size_id',$this->size_id);
		$criteria->compare('color_id',$this->color_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('name_jp',$this->name_jp,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('update_at',$this->update_at,true);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('update_by',$this->update_by);*/

        //$criteria->compare('name',$this->search,true);
        //$criteria->compare('item_number',$this->search,true);


		if (Yii::app()->user->getState('archived', Yii::app()->params['defaultArchived']) == 'true') {
			$criteria->condition = 'name LIKE :search OR item_number LIKE :search OR barcode LIKE :search' ;
			$criteria->params = array(
				':search' => '%' . $this->search . '%',
			);
		} else {
			$criteria->condition = 'status=:active_status AND (name LIKE :search OR item_number LIKE :search OR barcode LIKE :search)';
			$criteria->params = array(
				':active_status' => Yii::app()->params['active_status'],
				':search' => '%' . $this->search . '%',
			);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function deleteItem($id)
	{
		Item::model()->updateByPk((int)$id, array('status' => Yii::app()->params['inactive_status']));
	}

	public function restoreItem($id)
	{
		Item::model()->updateByPk((int)$id, array('status' => Yii::app()->params['active_status']));
	}

	public function suggest($keyword, $limit = 20)
	{

		$models = $this->findAll(array(
			'condition' => '(name LIKE :keyword or barcode=:barcode) and status=:status',
			//'order' => 'name',
			'limit' => $limit,
			'params' => array(
				':keyword' => "%$keyword%",
				':barcode' => $keyword,
				':status' => Yii::app()->params['active_status']
			)
		));
		$suggest = array();
		foreach ($models as $model) {
			$suggest[] = array(
				'label' => $model->name . ' : '  . $model->barcode,
				// label for drop-down list
				'value' => $model->name,
				'id' => $model->id,
			);
		}

		return $suggest;
	}

	public function getItemById($id)
	{
		$sql="SELECT item_id,name,name_jp,barcode,item_number,size,color_name,image
		      FROM v_item
		      WHERE item_id=:id
		      AND status=:status";

		$result = Yii::app()->db->createCommand($sql)->queryAll(true, array(
				':id' => $id,
				':status' => Yii::app()->params['active_status'],
			)
		);

		return $result;
	}

	public function getItemByBarcode($id)
	{
		$sql = "SELECT item_id,name,name_jp,barcode,item_number,size,color_name,image
		      FROM v_item
		      WHERE barcode=:id
		      AND status=:status";

		$result = Yii::app()->db->createCommand($sql)->queryAll(true, array(
				':id' => $id,
				':status' => Yii::app()->params['active_status'],
			)
		);

		return $result;
	}


}
