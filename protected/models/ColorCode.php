<?php

/**
 * This is the model class for table "color_code".
 *
 * The followings are the available columns in table 'color_code':
 * @property integer $id
 * @property string $barcode_number
 * @property string $no
 * @property string $size
 * @property string $col
 * @property string $qual
 */
class ColorCode extends CActiveRecord
{
    public $archived;

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'color_code';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('barcode_number, size', 'required'),
			array('barcode_number', 'unique'),
			array('barcode_number', 'length', 'max'=>20),
			array('no', 'length', 'max'=>10),
			array('size', 'length', 'max'=>5),
			array('col, col_description', 'length', 'max'=>50),
			array('qual, color_code_name', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('barcode_number, no, size, col, qual, color_code_name', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'barcode_number' => 'Barcode',
			'no' => 'No',
			'size' => 'Size',
			'col' => 'Col',
			'qual' => 'Qual',
            'color_code_name' => 'Color Code/Name'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('barcode_number',$this->barcode_number,true);
		$criteria->compare('no',$this->no,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('col',$this->col,true);
		$criteria->compare('qual',$this->qual,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ColorCode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getColorCode() {

        $sql="SELECT id,barcode_number,NO,size,col,color_code_name
              FROM `color_code`
              WHERE status=:status";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(':status' =>  Yii::app()->params['active_status']));
        return $result;
    }

    public function suggest($keyword, $limit = 20)
    {

        $models = $this->findAll(array(
            'condition' => '(size LIKE :keyword or barcode_number=:item_number) and status=:status',
            //'order' => 'name',
            'limit' => $limit,
            'params' => array(
                ':keyword' => "%$keyword%",
                ':item_number' => $keyword,
                ':status' => Yii::app()->params['active_status']
            )
        ));
        $suggest = array();
        foreach ($models as $model) {
            $suggest[] = array(
                'label' => $model->col . ' : '  . $model->size,
                // label for drop-down list
                'value' => $model->col,
                // value for input field
                'id' => $model->id,
            );
        }

        return $suggest;
    }

    public function restore($id)
    {
        ColorCode::model()->updateByPk((int)$id, array('status' => Yii::app()->params['active_status']));
    }

    public function archive($id)
    {
        ColorCode::model()->updateByPk((int)$id, array('status' => Yii::app()->params['inactive_status']));
    }
}
