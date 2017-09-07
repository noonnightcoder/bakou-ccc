<?php

class Dashboard extends CFormModel
{

    public function countTransaction($int_val=0)
    {
        $sql = "SELECT SUM(amount) amount,SUM(lastweek_amount) lastweek_amount, FORMAT(IFNULL((SUM(amount) - SUM(lastweek_amount))/SUM(lastweek_amount)*100,0),0) diff_percent
                FROM (
                SELECT COUNT(*) amount, 0 lastweek_amount
                FROM v_transaction_all
                WHERE DATE(create_at) = CURDATE() - :int_val
                UNION ALL
                SELECT 0 amount, COUNT(*) lastweek_amount
                FROM v_transaction_all
                WHERE DATE(create_at) = CURDATE()-7 - :int_val
                ) AS t1";

        return Yii::app()->db->createCommand($sql)->queryAll(true,
            array(
                ':int_val' => $int_val,
            )
        );
    }

    public function monthlyTransaction($int_val=1)
    {
        $sql = "SELECT SUM(amount) amount,SUM(previous_amount) previous_amount, FORMAT(IFNULL((SUM(amount) - SUM(previous_amount))/SUM(previous_amount)*100,0),0) diff_percent
                FROM (
                SELECT COUNT(*) amount, 0 previous_amount
                FROM v_transaction_all
                WHERE DATE_FORMAT(create_at,'%m-%Y') = DATE_FORMAT(CURDATE(),'%m-%Y')
                UNION ALL
                SELECT 0 amount, COUNT(*) previous_amount
                FROM v_transaction_all
                WHERE DATE_FORMAT(create_at,'%m-%Y') = DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL :int_val MONTH),'%m-%Y')
                ) AS t1";

        return Yii::app()->db->createCommand($sql)->queryAll(true,
            array(
                ':int_val' => $int_val,
            )
        );
    }

    public function dailyScanChart()
    {
        $sql = "SELECT DATE_FORMAT(create_at,'%d-%m-%Y') date_report,
                    COUNT(CASE WHEN scan_status='Correct' THEN scan_status END) Correct,
                    COUNT(CASE WHEN scan_status='Incorrect' THEN scan_status END) Incorrect,
                    COUNT(*) Total
                FROM v_transaction_all
                WHERE DATE_FORMAT(create_at,'%m-%Y') = DATE_FORMAT(CURDATE(),'%m-%Y')
                GROUP BY DATE_FORMAT(create_at,'%d-%m-%Y')";

        return Yii::app()->db->createCommand($sql)->queryAll(true);
    }

    public function topProductByQty()
    {

        $sql = "SELECT  @ROW := @ROW + 1 AS rank,item_name,qty
                FROM (
                SELECT t2.name item_name,COUNT(t1.item_id) qty
                FROM v_transaction_all t1 JOIN item t2 ON t2.id =t1.item_id
                WHERE DATE_FORMAT(t1.create_at,'%Y') = DATE_FORMAT(CURDATE(),'%Y')
                GROUP BY t2.name
                ORDER BY qty DESC LIMIT 10
                ) t1, (SELECT @ROW := 0) RADIANS";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true);

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'rank',
            'sort' => array(
                'attributes' => array(
                    'ntran',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }

    public function dashtopProductbyAmount()
    {

        $sql = "SELECT  @ROW := @ROW + 1 AS rank,item_name,qty,amount
                FROM (
                SELECT (SELECT NAME FROM item i WHERE i.id=si.item_id) item_name,COUNT(*) qty,SUM(price*quantity) amount
                FROM sale_item si INNER JOIN sale s ON s.id=si.sale_id
                     AND s.locatoin_id=:locatoin_id
                     AND sale_time BETWEEN DATE_FORMAT(NOW() ,'%Y') AND NOW()
                     AND s.status=:status
                GROUP BY item_name
                ORDER BY amount DESC LIMIT 10
                ) t1, (SELECT @ROW := 0) r";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true, array(
            ':location_id' => Yii::app()->getsetSession->getLocationId(),
            ':status' => Yii::app()->params['sale_complete_status']
        ));

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'rank',
            'sort' => array(
                'attributes' => array(
                    'sale_time',
                ),
            ),
            'pagination' => false,
        ));

        return $dataProvider; // Return as array object
    }

    public function dashtopFood()
    {
        $sql = "SELECT  @ROW := @ROW + 1 AS rank,item_name,qty,amount
                    FROM (
                    SELECT i.name item_name,SUM(si.quantity) qty,SUM(si.quantity*si.price) amount
                    FROM sale s , sale_item si , item i
                    WHERE s.id=si.sale_id
                    AND si.item_id=i.id
                    AND YEAR(s.sale_time) = YEAR(NOW())
                    AND s.status='1'
                    AND category_id=9
                    GROUP BY i.name
                    ORDER BY qty DESC LIMIT 10
                    ) t1, (SELECT @ROW := 0) r
                ";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true);

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'rank',
            'pagination' => false,
        ));

        return $dataProvider;
    }

    public function dashtopBeverage()
    {
        $sql = "SELECT  @ROW := @ROW + 1 AS rank,item_name,qty,amount
                    FROM (
                    SELECT i.name item_name,SUM(si.quantity) qty,SUM(si.quantity*si.price) amount
                    FROM sale s , sale_item si , item i
                    WHERE s.id=si.sale_id
                    AND si.item_id=i.id
                    AND YEAR(s.sale_time) = YEAR(NOW())
                    AND s.status='1'
                    AND category_id=1
                    GROUP BY i.name
                    ORDER BY qty DESC LIMIT 10
                    ) t1, (SELECT @ROW := 0) r
                ";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll(true);

        $dataProvider = new CArrayDataProvider($rawData, array(
            'keyField' => 'rank',
            'pagination' => false,
        ));

        return $dataProvider;
    }

}
