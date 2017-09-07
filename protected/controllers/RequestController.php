<?php

class RequestController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            'ajaxOnly -uploadFile'
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array(
                    'suggestItem',
                ),
                'users' => array('*'),
            ),
            array(
                'deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * @return array actions
     */
    public function actions()
    {
        return array(
            'suggestItem' => array(
                'class' => 'ext.actions.XSuggestAction',
                'modelName' => 'Item',
                'methodName' => 'suggest',
            ),
        );
    }
}