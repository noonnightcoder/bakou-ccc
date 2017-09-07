<div class="table-header">
    <?= Yii::t('app','The last 10 scan'); ?>
</div>

<?php $this->widget('\TbGridView', array(
    'id' => $grid_id,
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'dataProvider' => $data_provider,
    'template' => "{items}\n",
    'columns' => $grid_columns,
));