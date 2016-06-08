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

    $('.race-name').click( function(){
        var race = $(this).attr('rel').split('|');
        open_fiche('/race/view/id/' + race[0]);
    });


    $('.valid-training').click( function(){
        if( parseInt($('#training-trot').val()) > 4 ||
            parseInt($('#training-galop').val()) > 4 ||
            parseInt($('#training-endurance').val()) > 4 ||
            parseInt($('#training-vitesse').val()) > 4 ||
            parseInt($('#training-physique').val()) > 4 ){
            alert('invalid data');
        }else {
            var $data = 'training_trot=' + $('#training-trot').val();
            $data += '&training_galop=' + $('#training-galop').val();
            $data += '&training_endurance=' + $('#training-endurance').val();
            $data += '&training_vitesse=' + $('#training-vitesse').val();
            $data += '&training_physique=' + $('#training-physique').val();
            $data += '&horse_id=' + $('#horse_id').val();
            $data += '&training_fatigue=' + $('#current-fatigue-value').val();
            $.ajax({
                type: 'post',
                url: '/horse/validTraining/',
                data: $data,
                success: function () {

                }
            });
            $("#alert-valid-training").dialog("open");
        }
    });
});

function open_fiche(url)
{
    var w = window.open(url,'Fiche ' + Math.floor((Math.random() * 100) + 1),'menubar=no, scrollbars=yes, width=800, height=800');
}


function open_dialog_confirm(txt, url)
{
    $( txt ).dialog({
        autoOpen: false,
        width: 400,
        buttons: [
            {
                text: "Valider",
                click: function() {

                }
            },
            {
                text: "Annuler",
                click: function() {
                    $( this ).dialog( "close" );
                }
            }
        ]
    });
}
