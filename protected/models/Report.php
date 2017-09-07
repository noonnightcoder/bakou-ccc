<?php

class Report extends CFormModel
{

    public $from_date;
    public $to_date;
    public $date_report;


    /*
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    */

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'date_report' => Yii::t('app','Date'),
        );
    }

    public function dailyScan()
    {
        $sql = "SELECT DATE_FORMAT(create_at,'%d-%m-%Y') date_report,
                COUNT(CASE WHEN scan_status='Correct' THEN scan_status END) Correct,
                COUNT(CASE WHEN scan_status='Incorrect' THEN scan_status END) Incorrect,
                COUNT(*) Total
            FROM `v_transaction_all`
            WHERE create_at>=str_to_date(:from_date,'%d-%m-%Y')
            AND create_at<=date_add(str_to_date(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY)
            GROUP BY DATE_FORMAT(create_at,'%d-%m-%Y')
            ORDER BY DATE_FORMAT(create_at,'%d-%m-%Y')
            ";

        $raw_data = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(':from_date' => $this->from_date, ':to_date' => $this->to_date));

        $dataProvider = new CArrayDataProvider($raw_data, array('keyField' => 'date_report'));

        return $dataProvider;

    }

    public function dailyScanByItemNo()
    {
        $sql = "SELECT DATE_FORMAT(t1.create_at,'%d-%m-%Y') date_report,t2.item_number,
            COUNT(CASE WHEN scan_status='Correct' THEN scan_status END) Correct,
            COUNT(CASE WHEN scan_status='Incorrect' THEN scan_status END) Incorrect,
            COUNT(*) Total
            FROM `v_transaction_all` t1 JOIN item t2 ON t2.id=t1.item_id
            WHERE t1.create_at>=str_to_date(:from_date,'%d-%m-%Y')
            AND t1.create_at<=date_add(str_to_date(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY)
            GROUP BY DATE_FORMAT(t1.create_at,'%d-%m-%Y'),t2.item_number,scan_status
            ORDER BY DATE_FORMAT(t1.create_at,'%d-%m-%Y') desc
            ";

        $raw_data = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(':from_date' => $this->from_date, ':to_date' => $this->to_date));

        $dataProvider = new CArrayDataProvider($raw_data, array('keyField' => 'date_report'));

        return $dataProvider;

    }

    public function detailScan()
    {
        $sql = "SELECT t1.id id,DATE_FORMAT(t1.create_at,'%d-%m-%Y') date_report,
            DATE_FORMAT(t1.create_at,'%H:%i:%s') times,
            t2.item_number,t3.name size_name,t4.name color_name,
            concat(first_name,' ', last_name) scanner,t1.scan_status
            FROM `v_transaction_all` t1 JOIN item t2 ON t2.id=t1.item_id
                join employee e on e.id=t1.create_by
                left join item_size t3 on t3.id=t2.size_id
                left join item_color t4 on t4.id=t2.color_id
            WHERE t1.create_at>=str_to_date(:from_date,'%d-%m-%Y')
            AND t1.create_at<=date_add(str_to_date(:to_date,'%d-%m-%Y'),INTERVAL 1 DAY)
            ORDER BY DATE_FORMAT(t1.create_at,'%d-%m-%Y')
            ";

        $raw_data = Yii::app()->db->createCommand($sql)->queryAll(true,
            array(':from_date' => $this->from_date, ':to_date' => $this->to_date));

        $dataProvider = new CArrayDataProvider($raw_data, array('keyField' => 'id'));

        return $dataProvider;
    }

}