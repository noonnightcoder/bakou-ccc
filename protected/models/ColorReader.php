<?php

/**
 * This is the model class for table "color_reader".
 *
 * The followings are the available columns in table 'color_reader':
 * @property string $id
 * @property integer $color_code_id
 * @property integer $target_color_code_id
 * @property string $create_at
 * @property string $update_at
 * @property integer $create_by
 */
class ColorReader extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'color_reader';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('color_code_id, target_color_code_id', 'required'),
			array('color_code_id, target_color_code_id, create_by', 'numerical', 'integerOnly'=>true),
			array('create_at, update_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, color_code_id, target_color_code_id, create_at, update_at, create_by', 'safe', 'on'=>'search'),
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
			'color_code_id' => 'Color Code',
			'target_color_code_id' => 'Target Color Code',
			'create_at' => 'Create At',
			'update_at' => 'Update At',
			'create_by' => 'Create By',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('color_code_id',$this->color_code_id);
		$criteria->compare('target_color_code_id',$this->target_color_code_id);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('update_at',$this->update_at,true);
		$criteria->compare('create_by',$this->create_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ColorReader the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function saveColorReader($color_code_id,$target_color_code_id,$employee_id)
    {
        $model = new ColorReader;

        $model->color_code_id = $color_code_id;
        $model->target_color_code_id = $target_color_code_id;
        $model->create_by = $employee_id;

        $model->save();
    }
}
