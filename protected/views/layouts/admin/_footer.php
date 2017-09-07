<script>
    $(document).ready(function () {
        window.setTimeout(function () {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function () {
                $(this).remove();
            });
        }, 2000);
    });

    jQuery( function($){
        $('div#<?= $main_div_id ?>').on('click','a.btn-undodelete',function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to do undo delete this Item?')) {
                return false;
            }
            var url=$(this).attr('href');
            $.ajax({url:url,
                type : 'post',
                beforeSend: function() { $('.waiting').show(); },
                complete: function() { $('.waiting').hide(); },
                success : function(data) {
                    $.fn.yiiGridView.update('<?= $grid_id ?>');
                    return false;
                }
            });
        });
    });
</script>

<div class="waiting"><!-- Place at bottom of page --></div>