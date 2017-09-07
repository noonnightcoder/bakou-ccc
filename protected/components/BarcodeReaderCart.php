<?php

if (!defined('YII_PATH'))
    exit('No direct script access allowed');

class BarcodeReaderCart extends CApplicationComponent
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

    public function getSampleItem()
    {
        $this->setSession(Yii::app()->session);
        if (!isset($this->session['bcr_sample_item'])) {
            $this->setSampleItem(null);
        }
        return $this->session['bcr_sample_item'];
    }

    public function setSampleItem($data)
    {
        $this->setSession(Yii::app()->session);

        $items = Item::model()->getItemById($data);

        if (empty($items)) {
            $items = Item::model()->getItemByBarcode($data);
        }

        if (!$items) {
            return false;
        }

        foreach ($items as $item) {

            $item_data =  array((int) $item["item_id"] =>
                array(
                    'item_id' => $item["item_id"],
                    'name' => $item["name"],
                    'name_jp' => $item["name_jp"],
                    'barcode' => $item["barcode"],
                    'item_number' => $item["item_number"],
                    'size' => $item["size"],
                    'color_name' => $item["color_name"],
                    'image' => $item["image"],
                )
            );
        }

        $this->session['bcr_sample_item'] = $item_data;

        return true;
    }

    public function clearSampleItem()
    {
        $this->setSession(Yii::app()->session);
        unset($this->session['bcr_sample_item']);
    }


    public function clearAll()
    {
        $this->clearSampleItem();

    }

}
