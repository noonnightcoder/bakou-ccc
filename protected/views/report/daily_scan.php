<?php $this->renderPartial('partial/_header', array(
    'report' => $report,
    'from_date' => $from_date,
    'to_date' => $to_date
)); ?>

<br />

<div id="report_grid">

    <?php $this->renderPartial('partial/_grid', array(
        'report' => $report,
        'raw_data' => $report->dailyScan(),
        'key_field' => 'date_report',
        'sort_field' => 'date_report',
        'grid_columns' => $grid_columns,
        'grid_id' => $grid_id,
        'title' => $title,
        'from_date' => $from_date,
        'to_date' => $to_date,
    )); ?>

</div>


