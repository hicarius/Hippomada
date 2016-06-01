jQuery( document ).ready( function( $ ) {
    $('.menu li').click( function(){
        document.location = $(this).children('a').attr('href');
    });
});
