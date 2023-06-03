
$(document).ready(function(){

$("input[name='contact']").click(function(){
    $cid = this.id
          $.ajax({
             url: 'server.php',
             type: 'post',
             data: {contact: $cid},
             success: function(response){
                if ($('#show_contact'+$cid).children().length == 0){
                    $('#show_contact'+$cid).html(response);
                }
                else{
                $('#show_contact'+$cid).empty().append('')
                }
                 
              }
          });
    console.log($cid)
    });


    $("button[name='izmeniOglas']").click(function(){
        $cid = this.id.split("izmeni")[1]
              $.ajax({
                 url: 'server.php',
                 type: 'post',
                 data: {editAd: $cid, },
                 success: function(response){
                    if (response==1)
                        window.location.href = 'oglas.php?id='+$cid;
                    
                  }
              });
        });

    
        $("input[name='sacuvajPretragu']").click(function(){
        

        });

        $("input[name='pretraziM']").click(function(){

            $brendM =   $("input[id='markaM']").val()
            $modelM =   $("input[id='modelM']").val()
            $tip = $("select[id='tipM']").val()
            console.log($brendM,$modelM,$tip);
            $.ajax({
                url: 'server.php',
                type: 'post',
                data: {pretragaM:' ', brendM:$brendM,modelM:$modelM,tip:$tip},
                success: function(response){
                   $("div[id='ovde']").empty().append(response);  
                   
                 }
             });
       });

            
        
        $("input[name='pretrazi']").click(function(){
            $page=$("p[class='pageShow']").text()
            $brendS =   $("select[id='brend']").val()
            $modelS =   $("input[id='model']").val()
            $odgodauta =   $("input[id='odgodauta']").val()
            $dogodauta =   $("input[id='dogodauta']").val()
            $kilometrazaS =   $("input[name='kilometrazaS']").val()
            $gorivoS =   $("select[id='gorivo']").val()
            $menjacS =   $("select[id='menjac']").val()
            $bojeS =   $("select[id='boje']").val()
            $registracijaS =   $("select[id='registracija']").val()
            $cenaod =   $("input[name='cenaod']").val()
            $cenado =   $("input[name='cenado']").val()
            //update fieldse
            $po_cemu = $("input[name='po_cemu']:checked").val()
            $kako = $("input[name='kako']:checked").val()
            
            console.log($brendS,$modelS,$odgodauta,$dogodauta,$kilometrazaS,$gorivoS,$menjacS,$bojeS,$registracijaS,$cenaod,$cenado,"!!!!"+$page+"!!!!",$po_cemu,$kako)
            console.log($cenaod,$cenado);

            $.ajax({
                url: 'server.php',
                type: 'post',
                data: {unesiNovuPretragu:' ', brendS:$brendS,modelS:$modelS,odgodauta:$odgodauta,dogodauta:$dogodauta,kilometrazaS:$kilometrazaS,gorivoS:$gorivoS,menjacS:$menjacS,bojeS:$bojeS,registracijaS:$registracijaS,cenaod:$cenaod,cenado:$cenado,po_cemu:$po_cemu,kako:$kako},
                success: function(response){ 
                   
                 }
             });
            

                  $.ajax({
                     url: 'server.php',
                     type: 'post',
                     data: {pretraga:' ', brendS:$brendS,modelS:$modelS,odgodauta:$odgodauta,dogodauta:$dogodauta,kilometrazaS:$kilometrazaS,gorivoS:$gorivoS,menjacS:$menjacS,bojeS:$bojeS,registracijaS:$registracijaS,cenaod:$cenaod,cenado:$cenado,page:$page,po_cemu:$po_cemu,kako:$kako},
                     success: function(response){
                        $page=0;
                        $("div[id='ovde']").empty().append(response);  
                        
                      }
                  });
            });

    

        });


$(document).on("click",".prethodnastrana", function (event) {
    $page=$("p[class='pageShow']").text()
    event.preventDefault();

    if($page>0){
        $page=parseInt($page)-1;
        $("p[class='pageShow']").text($page)
        
        
         $("input[name='pretrazi']").trigger('click');
    }
    else{
    }
    
   });

   $(document).on("click",".sledecastrana", function (event) {
    $numr = $("p[name='brojredova']").first().text()
    $ceiling =Math.floor($numr/20);
    $remainder = $numr%20;
    
    if($remainder>0){
        $ceiling+=1;
    }
    console.log($numr,$ceiling)
    event.preventDefault();
    $page=$("p[class='pageShow']").text()
    if($page<$ceiling-1){
        $page=parseInt($page)+1;
        



        $("p[class='pageShow']").text($page)
        $("input[name='pretrazi']").trigger('click');
        
        console.log($page,$("p[class='pageShow']").text())
    }
    else{
    }

   });

$(document).on("click",".prikaziviseoglas", function (event) {
    event.preventDefault();
    console.log("klik")
        $cid = this.id.split("prikazVise")[1]
        window.location.href = 'oglasinfo.php?id='+$cid;
   });

   $(document).on("click",".prikazikontakt", function (event) {
    event.preventDefault();
    $cid = this.id
          $.ajax({
             url: 'server.php',
             type: 'post',
             data: {contact: $cid},
             success: function(response){
                if ($('#show_contact'+$cid).children().length == 0){
                    $('#show_contact'+$cid).html(response);
                }
                else{
                $('#show_contact'+$cid).empty().append('')
                }
                 
              }
          });
    console.log($cid)
   });