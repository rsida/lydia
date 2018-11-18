$(function() {

    $(document).on('submit', '.ajax-form', function (event) {

        event.preventDefault();

        $(document).trigger('loadingStart');

        $.ajax({
            type: $(this).attr('method'),
            url:  $(this).attr('action'),
            data: $(this).serialize()
        })
        .done(function (response) {
            $('.form').html(response.data);

            if (response.state === false) {
                $(document).trigger('sendErrorNotificationAjaxFormResponse');
            }
        })
        .always(function () {
            $(document).trigger('loadingEnd');
        });

    });

    $(document).on('sendErrorNotificationAjaxFormResponse', function () {
        $('.ajax-form').find('.form-field').each(function (index, rawField) {
            let field  = $(rawField),
                errors = JSON.parse(field.attr('data-errors'));

            for (let i = 0; i < errors.length; i++) {
                $(document).notify(field.attr('placeholder') + ': ' + errors[i], 'error');
            }
        });
    });

    $(document).on('loadingStart', function () {
        let loaderContainer = $('<div>').addClass('loader'),
            imgLoader = $('<img>').attr('src', '/img/rings-loader.svg');

        $('.form').append(loaderContainer.append(imgLoader));
    }).on('loadingEnd', function () {
        $('.form').find('.loader').remove();
    });

});
