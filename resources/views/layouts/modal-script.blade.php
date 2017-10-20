<script>
    $('.flexdatalist').each(function () {
        var readonly = $(this).prop('readonly');
        if (!readonly) {
            $(this).flexdatalist();
        }
    });
    $('.disable-all :input').prop('disabled', true);
    $('.disable-all :button').prop('disabled', true);
    $('form[data-toggle="validator"]').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            e.preventDefault();
            var url = $(this).prop('action');
            var data = $(this).serialize();
            $.post(url, data, function (data) {
                switch (data.status) {
                    case 'ERRO':
                        $('#msg-fr-modal').html(data.msg);
                        break;
                    case 'OK' :
                        window.location.href = data.redirect;
                        break;
                }
            });
        }
    });
</script>