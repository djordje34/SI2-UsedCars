$(document).ready(function(){


    $("select[id='adminIzbor']").on('change', function (e) {
        $optionSelected = $("option:selected", this);
        $valueSelected = this.value;

        if($valueSelected=='Korisnici'){
            $.ajax({
                url: 'server.php',
                type: 'post',
                data: {prikazSvihKorisnika: 1},
                success: function(response){
                   $('#printOvde').empty().append(response); 
                }
             });
        }
        else if($valueSelected=='Odobreni oglasi'){
            $.ajax({
                url: 'server.php',
                type: 'post',
                data: {prikazSvihOdobrenihOglasa: 1},
                success: function(response){
                   $('#printOvde').empty().append(response); 
                }
             });
        }
        else if($valueSelected=='Neodobreni oglasi'){
            $.ajax({
                url: 'server.php',
                type: 'post',
                data: {prikazSvihNeodobrenihOglasa: 1},
                success: function(response){
                   $('#printOvde').empty().append(response); 
                }
             });
        }

    });


});


$(document).on("click",".brisanje", function (event) {
    event.preventDefault();
    $id = this.id.split('obrisi')[1];
    console.log("da")
    $.ajax({
        url: 'server.php',
        type: 'post',
        data: {obrisiOglas: $id},
        success: function(response){
            $("tr[id='red"+$id+"']").empty().append("<td colspan='15'>"+response+"</td>");
        }
     });

});

$(document).on("click",".pogledaj", function (event) { //popraviti
    event.preventDefault();
    $id = this.id.split('pogledajOglas')[1];
    window.location.href='oglasinfo.php?id='+$id;

});


$(document).on("click",".brisanjeKorisnika", function (event) { //popraviti
    event.preventDefault();
    $id = this.id.split('obrisiK')[1];
    console.log("da")
    $.ajax({
        url: 'server.php',
        type: 'post',
        data: {obrisiKorisnika: $id},
        success: function(response){
            $("tr[id='red"+$id+"']").empty().append("<td colspan='15'>"+response+"</td>");
        }
     });

});


$(document).on("click",".prihvatanje", function (event) { //popraviti
    event.preventDefault();
    $id = this.id.split('prihvati')[1];
    console.log("da")
    $.ajax({
        url: 'server.php',
        type: 'post',
        data: {prihvatiOglas: $id},
        success: function(response){
            $("tr[id='red"+$id+"']").empty().append("<td colspan='15'>"+response+"</td>");
        }
     });

});



