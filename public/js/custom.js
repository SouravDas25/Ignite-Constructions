
new WOW().init();

$(document).ready(function () {

    $('select').addClass("browser-default");

    $('[type=date]').addClass('datepicker').attr('type','text');
    $('.datepicker').pickadate(
        {
            format: 'yyyy-mm-dd',
        }
    );


});
