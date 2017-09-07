<?php

/**
 * This is the model class for table "transaction_log".
 *
 * The followings are the available columns in table 'transaction_log':
 * @property string $id
 * @property integer $item_id
 * @property integer $target_item_id
 * @property string $status
 * @property string $create_at
 * @property string $update_at
 * @property integer $create_by
 */
class TransactionLog extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'transaction_log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('item_id, target_item_id', 'required'),
            array('item_id, target_item_id, create_by, update_by', 'numerical', 'integerOnly' => true),
            array('status', 'length', 'max' => 1),
            array('create_at, update_at', 'safe'),
            array(
                'create_at,update_at',
                'default',
                'value' => date('Y-m-d H:i:s'),
                'setOnEmpty' => false,
                'on' => 'insert'
            ),
            array('update_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => false, 'on' => 'update'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, item_id, target_item_id, status, create_at, update_at, create_by, update_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'item_id' => 'Item',
            'target_item_id' => 'Target Item',
            'status' => 'Status',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('target_item_id', $this->target_item_id);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('create_at', $this->create_at, true);
        $criteria->compare('update_at', $this->update_at, true);
        $criteria->compare('create_by', $this->create_by);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TransactionLog the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function cancelTransaction($id,$employee_id)
    {
        TransactionLog::model()->updateByPk((int)$id, array('status' => Yii::app()->params['inactive_status'], 'update_by' => $employee_id, 'update_at' => date('Y-m-d H:i:s')));
    }

    public function restoreTransaction($id,$employee_id)
    {
        TransactionLog::model()->updateByPk((int)$id, array('status' => Yii::app()->params['active_status'], 'update_by' => $employee_id, 'update_at' => date('Y-m-d H:i:s')));
    }

    public function saveTransactionLog($item_id, $target_item_id, $employee_id)
    {
        $model = new TransactionLog;

        $model->item_id = $item_id;
        $model->target_item_id = $target_item_id;
        $model->create_by = $employee_id;

        $model->save();
    }

    public function countTotalTran($item_id,$scan_status)
    {
        $sql = "SELECT count(id) ncount
			FROM v_transaction
			WHERE target_item_id=:item_id
			AND `status` = :active_status
			AND scan_status = :scan_status
			";

        $result = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(
                ':item_id' => $item_id,
                ':active_status' => Yii::app()->params['active_status'],
                ':scan_status' => $scan_status
            ));


        foreach ($result as $record) {
            $total = $record['ncount'];
        }

        return $total;


    }

    public function countTranAll($item_id)
    {
        $sql = "SELECT scan_status,count(id) ncount
			FROM v_transaction
			WHERE target_item_id=:item_id
			AND `status` = :active_status
			GROUP BY scan_status
			";

        return Yii::app()->db->createCommand($sql)->queryAll(true,
            array(':item_id' => $item_id, ':active_status' => Yii::app()->params['active_status']));

    }

    public function countTranByStatus($item_id, $num_day = 0)
    {
        $sql = "SELECT scan_status,count(id) ncount
			FROM v_transaction
			WHERE DATE(create_at)= CURDATE() - :num_day
			AND target_item_id=:item_id
			AND `status` = :active_status
			GROUP BY scan_status
			";

        return Yii::app()->db->createCommand($sql)->queryAll(true, array(
            ':item_id' => $item_id,
            ':num_day' => $num_day,
            ':active_status' => Yii::app()->params['active_status']
        ));

    }

    public function detailGridScan($item_id, $n_top = 10)
    {
        $sql = "SELECT t1.id id,DATE_FORMAT(t1.create_at,'%d-%m-%Y') date_report,
            DATE_FORMAT(t1.create_at,'%H:%i:%s') times,
            t2.item_number,t3.name size_name,t4.name color_name,
            concat(first_name,' ', last_name) scanner,t1.scan_status,t1.status,t1.create_at
            FROM v_transaction t1 JOIN item t2 ON t2.id=t1.item_id
                join employee e on e.id=t1.create_by
                left join item_size t3 on t3.id=t2.size_id
                left join item_color t4 on t4.id=t2.color_id
            WHERE t1.target_item_id=:item_id
            ORDER BY t1.create_at desc
            LIMIT $n_top
            ";

        $raw_data = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(':item_id' => $item_id));

        $dataProvider = new CArrayDataProvider($raw_data, array('keyField' => 'id'));

        return $dataProvider;
    }

    public function transactionAchieve($item_id,$employee_id)
    {
        $sql="SELECT func_trans_achieve(:item_id,:employee_id) result_id";
        $result = Yii::app()->db->createCommand($sql)->queryAll(true, array(
                ':item_id' => $item_id,
                ':employee_id' => $employee_id,
            )
        );

        foreach ($result as $record) {
            $result_id = $record['result_id'];
        }

        return $result_id;

    }

}
