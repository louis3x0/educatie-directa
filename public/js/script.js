$(document).ready(function () {
    var isPhoneVisible = false;
    var originalText = '';

    $('.show-number').click(function () {
        if (!isPhoneVisible) {
            originalText = $('.phone-number').text();
            $('.phone-number').text('0745 123 456');
            $('.show-phone').text('Ascunde');
            isPhoneVisible = true;
        } else {
            $('.phone-number').text(originalText);
            $('.show-phone').text('Arată telefon');
            isPhoneVisible = false;
        }
    });
});

$(document).ready(function(){
    $('.btn-group-toggle label').on('click', function(){
        var labels = $('.btn-group-toggle label');
        labels.removeClass('active');
        $(this).addClass('active');
    });
});

