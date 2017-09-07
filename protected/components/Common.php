<?php
Class Common 
{
    public static function Discount($discount) {
        if (substr($discount, 0, 1) == '$') {
            $discount_amount = substr($discount, 1);
            $discount_type = '$';
        } else {
            $discount_amount = $discount;
            $discount_type = '%';
        }
        
        return array($discount_amount, $discount_type);
    }

    /*
   * To Calculate Total Amount after discount
   */
    public static function calTotalAfterDiscount($discount,$price,$qty=1) {
        $total = 0;
        if (substr($discount, 0, 1) == '$') {
            $total+=round($price * $qty - substr($discount, 1), Yii::app()->shoppingCart->getDecimalPlace(), PHP_ROUND_HALF_DOWN);
        } else {
            $total+=round($price * $qty - $price * $qty * $discount / 100, Yii::app()->shoppingCart->getDecimalPlace(), PHP_ROUND_HALF_DOWN);
        }
        return $total;
    }

    /*
     * To Calculate actual discount amount comparing to Total Value
     */
    public static function calDiscountAmount($discount,$price) {
        //$total = 0;
        if (substr($discount, 0, 1) == '$') {
            $total=round(substr($discount, 1), Yii::app()->shoppingCart->getDecimalPlace(), PHP_ROUND_HALF_DOWN);
        } else {
            $total=round($price * $discount / 100, Yii::app()->shoppingCart->getDecimalPlace(), PHP_ROUND_HALF_DOWN);
        }
        return $total;
    }

    /*
     * To get system decimal place
     */
    public static function getDecimalPlace()
    {
        return Yii::app()->settings->get('system', 'decimalPlace') == '' ? 2 : Yii::app()->settings->get('system', 'decimalPlace');
    }

    public static function timeAgo($date,$granularity=2) {
        $retval = '';
        $date = strtotime($date);
        $difference = time() - $date;
        $periods = array('decade' => 315360000,
            'year' => 31536000,
            'month' => 2628000,
            'week' => 604800,
            'day' => 86400,
            'hour' => 3600,
            'min' => 60,
            'sec' => 1);
        if ($difference < 5) { // less than 5 seconds ago, let's say "just now"
            $retval = "Just now";
            return $retval;
        } else {
            foreach ($periods as $key => $value) {
                if ($difference >= $value) {
                    $time = floor($difference/$value);
                    $difference %= $value;
                    $retval .= ($retval ? ' ' : '').$time.' ';
                    $retval .= (($time > 1) ? $key.'s' : $key);
                    $granularity--;
                }
                if ($granularity == '0') { break; }
            }
            return $retval.' ago';
        }
    }
    
}