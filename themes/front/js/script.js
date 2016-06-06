jQuery( document ).ready( function( $ ) {
    $('.menu li').click( function(){
        document.location = $(this).children('a').attr('href');
    });

    $('.fa-power-off').click(function () {
        document.location.href = '/index/disconnect/';
    });

    $('.horse-name').click( function(){
        var horse = $(this).attr('rel').split('|');
        open_fiche('/horse/view/id/' + horse[0], horse[1]);
    });
});

function open_fiche(url, cheval)
{
    window.open(url,'Fiche du cheval ' + cheval,'menubar=no, scrollbars=no, width=600, height=800');
}
