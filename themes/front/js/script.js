jQuery( document ).ready( function( $ ) {
    $('.menu li').click( function(){
        document.location = $(this).children('a').attr('href');
    });

    $('.fa-power-off').click(function () {
        document.location.href = '/index/disconnect/';
    });

    $('.horse-name').click( function(){
        var horse = $(this).attr('rel').split('|');
        open_fiche('/horse/view/id/' + horse[0]);
    });
});

function open_fiche(url)
{
    var w = window.open(url,'Fiche du cheval' + Math.floor((Math.random() * 100) + 1),'menubar=no, scrollbars=yes, width=800, height=800');
}
