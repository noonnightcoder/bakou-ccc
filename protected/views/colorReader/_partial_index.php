<?php
Yii::app()->clientScript->registerScript('colorOption', "
        jQuery( function($){
            $('#color_zone').on('click','a.color-btn', function(e) {
                e.preventDefault();
                var url=$(this).attr('href');
                $.ajax({url:url,
                        type : 'post',
                        beforeSend: function() { $('.waiting').show(); },
                        complete: function() { $('.waiting').hide(); },
                        success : function(data) {
                            $('#register_container').html(data);
                          }
                    });
                });
        });
      ");
?>

<script>

    var submitting = false;

    $(document).ready(function()
    {
        //Here just in case the loader doesn't go away for some reason
        $('.waiting').hide();

        // ajaxForm to ensure is submitting as Ajax even user press enter key
        $('#add_item_form').ajaxForm({target: "#register_container", beforeSubmit: salesBeforeSubmit, success: itemScannedSuccess});

        $('.line_item_form').ajaxForm({target: "#register_container", beforeSubmit: salesBeforeSubmit});

    });

    function salesBeforeSubmit(formData, jqForm, options)
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
        setTimeout(function(){$('#SaleItem_item_id').focus();}, 10);
     }

</script>

<script type="text/javascript" language="javascript">
    $(document).keydown(function(event)
    {
        var mycode = event.keyCode;
        //F1
        if ( mycode === 112) {
            $('#payment_amount_id').focus();
            $('#payment_amount_id').select();
        }

        //F2
        if ( mycode === 113) {
            $('#SaleItem_giftcard_id').focus();
        }

    });
</script>

<?php Yii::app()->clientScript->registerScript('setFocus', '$("#ColorCode_id").focus();'); ?>
