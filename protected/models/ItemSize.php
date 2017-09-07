<?php

/**
 * This is the model class for table "item_size".
 *
 * The followings are the available columns in table 'item_size':
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $status
 * @property string $create_at
 * @property string $update_at
 * @property integer $create_by
 * @property integer $update_by
 *
 * The followings are the available model relations:
 * @property Item[] $items
 */
class ItemSize extends CActiveRecord
{
	public $search;
	public $archived;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item_size';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('create_by, update_by', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=> 10),
			array('full_name', 'length', 'max'=>30),
			array('status', 'length', 'max'=>1),
			array('create_at,update_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
			array('update_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => false, 'on' => 'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, full_name, status, search', 'safe', 'on'=>'search'),
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
			'items' => array(self::HAS_MANY, 'Item', 'size_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t('app','Name'),
			'full_name' => Yii::t('app','Full Name'),
			'status' => 'Status',
			'create_at' => 'Create At',
			'update_at' => 'Update At',
			'create_by' => 'Create By',
			'update_by' => 'Update By',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('update_at',$this->update_at,true);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('update_by',$this->update_by);*/

		if (Yii::app()->user->getState('archivedItemSize', Yii::app()->params['defaultArchived']) == 'true') {
			$criteria->condition = 'name LIKE :search OR full_name LIKE :search' ;
			$criteria->params = array(
				':search' => '%' . $this->search . '%',
			);
		} else {
			$criteria->condition = 'status=:active_status AND (name LIKE :search OR full_name LIKE :search)';
			$criteria->params = array(
				':active_status' => Yii::app()->params['active_status'],
				':search' => '%' . $this->search . '%',
			);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSizeItemSize', Yii::app()->params['defaultPageSize']),
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemSize the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function saveItemSize($name)
    {
        $id=null;
        $exists = ItemSize::model()->exists('CONVERT(id,CHAR(3))=:id',array(':id'=> $name ));
        if (!$exists) {
            $model= new ItemSize;
			$model->name=$name;
			$model->save();
            $id=$model->id;
        }

        return $id;
    }

	public static function sizeByName($name = '') {

		$sql = "SELECT id ,name AS text
                FROM item_size
                WHERE (name LIKE :name)";

		$name = '%' . $name . '%';
		return Yii::app()->db->createCommand($sql)->queryAll(true, array(':name' => $name));

	}

	public function deleteItemSize($id)
	{
		ItemSize::model()->updateByPk((int)$id, array('status' => Yii::app()->params['inactive_status']));
	}

	public function restoreItemSize($id)
	{
		ItemSize::model()->updateByPk((int)$id, array('status' => Yii::app()->params['active_status']));
	}

}
