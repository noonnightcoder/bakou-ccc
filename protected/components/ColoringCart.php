<?php

if (!defined('YII_PATH'))
    exit('No direct script access allowed');

class ColoringCart extends CApplicationComponent
{

    private $session;

    //private $decimal_place;

    public function getSession()
    {
        return $this->session;
    }

    public function setSession($value)
    {
        $this->session = $value;
    }

    public function getDecimalPlace()
    {
        return Yii::app()->settings->get('system', 'decimalPlace') == '' ? 2 : Yii::app()->settings->get('system', 'decimalPlace');
    }

    public function getSaleCookie()
    {
        return Yii::app()->settings->get('system', 'saleCookie') == '' ? "0" : Yii::app()->settings->get('system', 'saleCookie');
    }

    public function getCart()
    {
        $cart=array();
        $cart=SaleOrder::model()->getOrderCart($this->getTableId(), $this->getGroupId(),Yii::app()->getsetSession->getLocationId());
        
        $this->settingSaleSum();
        
        return $cart;
    }

    public function setCart($cart_data)
    {
        $this->setSession(Yii::app()->session);
        $this->session['cart'] = $cart_data;
    }

    public function getColorId()
    {
        $this->setSession(Yii::app()->session);
        if (!isset($this->session['col_color_id'])) {
            $this->setColorId(null);
        }
        return $this->session['col_color_id'];
    }

    public function setColorId($data)
    {
        $this->setSession(Yii::app()->session);
        $this->session['col_color_id'] = $data;

    }

    public function clearColorId()
    {
        $this->setSession(Yii::app()->session);
        unset($this->session['col_color_id']);
    }

    public function clearAll()
    {
        $this->emptyPayment();
        $this->clearColorId();

    }

}
