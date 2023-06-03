$(document).ready(function(){

$("button[name='obrisiSliku']").click(function(){
    $cid = this.id
          $.ajax({
             url: 'server.php',
             type: 'post',
             data: {obrisiSliku: $cid},
             success: function(response){
    
                 alert(response);
                $id = 'prikaz'+$cid;
                 $("div[id="+$id+"]").empty().append("<p>Slika je obrisana.</p>");
              }
          });
    });
    $("button[name='obrisiOglas']").click(function(){
        $cid = this.id.split('obrisiOglas')[1]
              $.ajax({
                 url: 'server.php',
                 type: 'post',
                 data: {obrisiOglas: $cid},
                 success: function(response){
        
                    alert(response);
                    window.location.href='mojioglasi.php';
                  }
              });
        });

        $("button[name='promeniCenu']").click(function(){
            
            $cena = $("input[id='novaCena']").val();
            $id = this.id;
                  $.ajax({
                     url: 'server.php',
                     type: 'post',
                     data: {promeniCenu: $cena, potrebniID:$id},
                     success: function(response){
            
                        alert(response);

                      }
                  });
            });

});