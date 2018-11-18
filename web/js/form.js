$(function() {

    $(document).on('submit', '.ajax-form', function (event) {

        event.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url:  $(this).attr('action'),
            data: $(this).serialize()
        })
        .done(function (response) {
            if (response.state === true) {
                $.notify(response.message, 'success');
            } else {
                $('.form').html(response.data);
                $(document).trigger('sendErrorNotificationAjaxFormResponse');
            }
        });

    });

    $(document).on('sendErrorNotificationAjaxFormResponse', function () {
        $('.ajax-form').find('.form-field').each(function (index, rawField) {
            let field  = $(rawField),
                errors = JSON.parse(field.attr('data-errors'));

            for (let i = 0; i < errors.length; i++) {
                $.notify(field.attr('placeholder') + ': ' + errors[i], 'error');
            }
        });
    });

});
