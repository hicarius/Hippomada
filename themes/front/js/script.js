jQuery( document ).ready( function( $ ) {
    $('.menu li').click( function(){
        document.location = $(this).children('a').attr('href');
    });

    $('.fa-power-off').click(function () {
        document.location.href = '/index/disconnect/';
    });

    $('body').on('click', '.horse-name', function(){
        var horse = $(this).attr('rel').split('|');
        open_fiche('/horse/view/id/' + horse[0]);
    });

    $('body').on('click', '.race-name', function(){
        var race = $(this).attr('rel').split('|');
        if(typeof race[1] != 'undefined'){
            open_fiche('/races/view/id/' + race[0] + '/t/1');
        }else{
            open_fiche('/races/view/id/' + race[0]);
        }

    });

    $('body').on('click', '.stable-name', function(){
        var stable = $(this).attr('rel').split('|');
        open_fiche('/stable/view/id/' + stable[0]);
    });

    $('.valid-training').on( 'click', function(){
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
                    $("#alert-valid-training").dialog("open");
                }
            });
        }
    });

    // tooltip demo
    $('.bg-shadow').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    $('body').on('click', '.get-valid-race', function(){
        $.ajax({
            type: 'post',
            data: 'horse_id=' + $('#horse_id').val(),
            url: '/horse/validRaceForEngagement/',
            success: function(html){
                $('.valid-race-list').html(html);
            }
        });
    });

    $('body').on('click', '.engaged-this-race', function(){
        var race = $(this).attr('rel').split('|');
        $.ajax({
            type: 'post',
            data: 'horse_id=' + $('#horse_id').val() + '&race_id=' + race[0] + '&price=' + race[1] ,
            url: '/horse/engagedThisRace/',
            success: function(html){
                $("#alert-engaged-success").dialog("open");
            }
        });
    });

    $('body').on('click', '.disengaged-this-race', function(){
        var race = $(this).attr('rel').split('|');
        $.ajax({
            type: 'post',
            data: 'horse_id=' + $('#horse_id').val() + '&race_id=' + race[0] + '&price=' + race[1] ,
            url: '/horse/disengagedThisRace/',
            success: function(html){
                $("#alert-disengaged-success").dialog("open");
            }
        });
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
