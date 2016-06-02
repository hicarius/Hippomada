jQuery( document ).ready( function( $ ) {
    $('.menu li').click( function(){
        document.location = $(this).children('a').attr('href');
    });

    $('.fa-power-off').click(function () {
        document.location.href = '/index/disconnect/';
    });
});
