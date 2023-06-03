$(document).ready(function(){
$(document).on("click",".skriven", function (event) {
    $.ajax({
        url: 'server.php',
        type: 'post',
        data: {prikaziPretrageKorisnika: 1},
        success: function(response){
           $('#printOvde').empty().append(response); 
        }
     });
    });
});


$(document).on("click",".skriven", function (e) {
    e.preventDefault();
    $.ajax({
        url: 'server.php',
        type: 'post',
        data: {prikaziPretrageKorisnika: 1},
        success: function(response){
           $('#printOvde').empty().append(response); 
        }
     });
});


$(document).on("click",".ponoviPretragu", function (e) {
    e.preventDefault();
    $id = this.id.split("ponoviPretragu")[1]
    $brendS =   $("td[class='brend"+$id+"']").text()
    $modelS = $("td[class='model"+$id+"']").text()
    $odgodauta = $("td[class='odgod"+$id+"']").text()
    $dogodauta = $("td[class='dogod"+$id+"']").text()
    $kilometrazaS = $("td[class='kilometraza"+$id+"']").text()
    $gorivoS = $("td[class='gorivo"+$id+"']").text()
    $menjacS = $("td[class='menjac"+$id+"']").text()
    $bojeS = $("td[class='boje"+$id+"']").text()
    $registracijaS = $("td[class='registracija"+$id+"']").text()
    $cenaod = $("td[class='cenaod"+$id+"']").text()
    $cenado = $("td[class='cenado"+$id+"']").text()
    $po_cemu = $("td[class='po_cemu"+$id+"']").text()
    $kako = $("td[class='kako"+$id+"']").text()

    $.ajax({
        url: 'server.php',
        type: 'post',
        data: {unesiNovuPretragu: 1,brendS:$brendS,modelS:$modelS,odgodauta:$odgodauta,dogodauta:$dogodauta,kilometrazaS:$kilometrazaS,gorivoS:$gorivoS,menjacS:$menjacS,bojeS:$bojeS,registracijaS:$registracijaS,cenaod:$cenaod,cenado:$cenado,po_cemu:$po_cemu,kako:$kako},
        success: function(response){
            console.log(response)
            window.location.href = 'index.php';
        }
     });
});


$(document).on("click",".brisanjePretrage", function (e) {
    e.preventDefault();
    $id = this.id.split("obrisiPretragu")[1]


    $.ajax({
        url: 'server.php',
        type: 'post',
        data: {obrisiPretragu: $id},
        success: function(response){
            $("tr[id='red"+$id+"']").empty().append("<td colspan='15'>"+response+"</td>");
        }
     });
});
