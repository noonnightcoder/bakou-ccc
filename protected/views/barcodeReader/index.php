<div id="register_container">
    <?php
    if(!isset($sample_items)) {
        echo $this->renderPartial('_sample_item', array('model' => $model));
    } else {
        echo $this->renderPartial('_sample_item_select', array(
            'model' => $model,
            'alert' => $alert,
            'alert_type' => $alert_type,
            'sample_items' => $sample_items,
            'trans_status_all' => $trans_status_all,
            'trans_status_today' => $trans_status_today,
            'trans_status_yesterday' => $trans_status_yesterday,
            'grid_id' => $grid_id,
            'grid_columns' => $grid_columns,
            'data_provider' => $data_provider,
            'transaction_log' => $transaction_log,
        ));
    } ?>

<?php $this->renderPartial('_index', array('model' => $model)); ?>
