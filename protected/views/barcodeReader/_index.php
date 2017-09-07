<script>

    var submitting = false;

    $(document).ready(function()
    {
        //Here just in case the loader doesn't go away for some reason
        $('.waiting').hide();

        // ajaxForm to ensure is submitting as Ajax even user press enter key
        $('#scan_item_form').ajaxForm({target: "#register_container", beforeSubmit: beforeSubmit, success: itemScannedSuccess});

        $('#add_item_form').ajaxForm({target: "#register_container", beforeSubmit: beforeSubmit, success: itemScannedSuccess});

        $('#register_container').on('click','a.btn-reset-sample', function(e) {
            e.preventDefault();
            $('#scan_item_select_form').ajaxSubmit({target: "#register_container", beforeSubmit: beforeSubmit});
        });

        $('#all').on('click','a.btn-restore', function(e) {
            e.preventDefault();
            if (!confirm('<?= Yii::t('app','Are you sure you want to restore this scan?'); ?>')) {
                return false;
            }
            var url=$(this).attr('href');
            $.ajax({url:url,
                type : 'post',
                beforeSend: function() { $('.waiting').show(); },
                complete: function() { $('.waiting').hide(); },
                success : function(data) {
                    //$.fn.yiiGridView.update('detail-scan-grid');
                    $('#register_container').html(data);
                    return false;
                }
        });
        });

        $('#all').on('click','a.btn-cancel', function(e) {
            e.preventDefault();
            if (!confirm('<?= Yii::t('app','Are you sure you want to delete this scan?'); ?>')) {
                return false;
            }
            var url=$(this).attr('href');
            $.ajax({url:url,
                type : 'post',
                beforeSend: function() { $('.waiting').show(); },
                complete: function() { $('.waiting').hide(); },
                success : function(data) {
                    //$.fn.yiiGridView.update('detail-scan-grid');
                    $('#register_container').html(data);
                    return false;
                }
            });
        });

    });

    function beforeSubmit(formData, jqForm, options)
    {
        if (submitting)
        {
            return false;
        }
        submitting = true;
        $('.waiting').show();
    }


     function itemScannedSuccess(responseText, statusText, xhr, $form)
     {
        setTimeout(function(){$('#Item_id').focus();}, 10);
     }


    $('.bootbox').on('hidden.bs.modal', function () {
        setTimeout(function(){$('#Item_id').focus();}, 10);
    });

</script>

<script>
    $(document).ready(function () {
        window.setTimeout(function () {
            $(".alert").fadeTo(5000, 0).slideUp(5000, function () {
                $(this).remove();
            });
        }, 5000);
    });
</script>

<?php Yii::app()->clientScript->registerScript('setFocus', '$("#Item_id").focus();'); ?>

<?php /*
Yii::app()->clientScript->registerScript('restoreScan', "
        jQuery( function($){
            $('div#all').on('click','a.btn-restore',function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to do restore this scan?')) {
                    return false;
                }
                var url=$(this).attr('href');
                $.ajax({url:url,
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                            //$.fn.yiiGridView.update('detail-scan-grid');
                            $('#register_container').html(data);
                            return false;
                          }
                    });
                });
        });
      ");
  */
?>
