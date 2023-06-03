<?php

include "navbar.php";
if (!checkIfLogged()){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
       
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"/>
    <link rel="stylesheet" href="general.css"/>
    <link rel="stylesheet" href="forms.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"/>

<script>

$(document).ready(function(){
    
    $('#noviAuto input[type="text"]').keyup(function(){
        console.log($(this).val())
        if(!$(this).val() || !$(this).val().match(/^([0-9a-zA-Z]+)|([0-9a-zA-Z][0-9a-zA-Z\\s]+[0-9a-zA-Z]+)$/i)){
            console.log(!$(this).val() , $(this).val().match(/[^0-9a-z ]/i) , $(this).val().match(/[^0-9a-z]/i))
            $('#changer').attr('disabled', true);
            $("#checkUsername").text("Model mora imati barem 1 validan karakter.");
            
        } else{
            $('#changer').attr('disabled', false);
            $("#checkUsername").text("");
        }
    });
});

</script>

    </head>
    <body>
    <div class="container">
        

    <div class="d-flex justify-content-center form_container m-5" style="background-color:#EB6440;">
    <form method="POST" autocomplete="off" id="noviAuto" class="w-75 p-2">
    <div class="row mb-4">
        <div class="col-md-6">
    <div class="input-group mb-3">
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-car"></i></span>
							</div>
							<select id="brend" name="brend" class="form-select input_user">
                            <?php
                            $res=getBrands();
                            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                ?>
                                <option value="<?php echo $row['brand_id'] ?>"><?php echo $row['name'] ?></option>
                                <?php
                              }
                            ?>
                            </select>
                        </div>
                            </div>
                            <div class="col-md-6">
                        <div class="input-group mb-3">
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-font"></i></span>
							</div>
                            
							<input type="text" size="22" name="model" minlength="1" id="model" class="form-control input_user" placeholder="Unesite model automobila">
                        </div>
                            </div>
                            </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                            <label for="karoserija">Karoserija automobila</label> 
                        <div class="input-group mb-3">
                            
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-car-side"></i></span>
							</div>
                            
                            <select id="karoserija" name="karoserija" class="form-select input_user">
                            <?php
                            $res=getTypes();
                            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                ?>
                                <option value="<?php echo $row['body_id'] ?>"><?php echo $row['type'] ?></option>
                                <?php
                              }
                            ?>
                            </select>
                         </div>
                            </div>
                            <div class="col-md-6">
        <label for="vazecaregistracija">Važeća registracija?</label>
        <div class="input-group mb-3">
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-calendar"></i></span>
							</div>
        <select id="vazecaregistracija" name="vazecaregistracija" class="form-select input_user">
            
                <option value="Da">Da</option>
                <option value="Ne">Ne</option>
                            </select>

                            </div>
                            </div>
                            </div>
                        <div class="row mb-4">
        <div class="col-md-3">
            <label for="motor">Kubikaža motora</label>
            <div class="input-group mb-3">
                            
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-dumbbell"></i></span>
							</div>
            <input type="number" name="motor" class="form-control" step="1" min="200" max="6000" placeholder="Motor" size="8">
            </div>
                            </div>
            <div class="col-md-3">
            <label for="kilometraza">Kilometraža</label>

            <div class="input-group mb-3">
                            
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
							</div>

            <input type="number"  min="0" max="2000000" name="kilometraza" class="form-control" placeholder="Kilometraža" size="8">
            </div>
                            </div>                    

            

            <div class="col-md-6">
            <label for="gorivo">Gorivo</label>

            <div class="input-group mb-3">
                            
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-gas-pump"></i></span>
							</div>

                <select id="gorivo" name="gorivo" class="form-select input_user">
                <option value="Benzin">Benzin</option>
                <option value="Dizel">Dizel</option>
                <option value="Benzin+Gas (TNG)">Benzin+Gas (TNG)</option>
                <option value="Benzin+Metan (CNG)">Benzin+Gas (CNG)</option>
                <option value="Električni pogon">Električni pogon</option>
                <option value="Hibridni pogon">Hibridni pogon</option>
            </select>
            </div>
            </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6"> 
            <label for="menjac">Tip menjača</label>


            <div class="input-group mb-3">
                            
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-bolt"></i></span>
							</div>
                <select id="menjac" name="menjac" class="form-select input_user">
                <option value="Manuelni 4 brzine">Manuelni 4 brzine</option>
                <option value="Manuelni 5 brzina">Manuelni 5 brzina</option>
                <option value="Manuelni 6 brzina">Manuelni 6 brzina</option>
                <option value="Poluautomatski">Poluautomatski</option>
                <option value="Automatski">Automatski</option>
                </select>
            </div>
                            </div>
            <div class="col-md-3">
            <label for="boje">Boja automobila</label>

            <div class="input-group mb-3">
                            
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-palette"></i></span>
							</div>

            <select id="boje" name="boje" class="form-select input_user">
                            <?php
                            $res=getColors();
                            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                ?>
                                <option value="<?php
                                #$enc=mb_detect_encoding($row["boja_id"]);
                                #$fix=mb_convert_encoding($row["name"], $enc, 'windows-1252');
                                //$fix=iconv($enc, 'UTF-8',$row['name']);
                                $fix = $row['name'];
                                echo $row['boja_id'] ."\">" . $fix ?></option>
                                <?php
                              }
                            ?>
                            </select>

            </div>
            </div>
            <div class="col-md-3">

                            <label for="godauta" >Godina proizvodnje</label>

                            <div class="input-group mb-3">
                            
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
							</div>

                         <input type="number" name="godauta" id="godauta" min="1960" max="2023" step="1" value="2010" class="form-control input_user"/>
                         
                            </div>
                            </div>
            </div>
            <div class="row mb-4">
        <div class="col-md-6">
            <label for="vrata">Broj vrata</label>

            <div class="input-group mb-3">
                            
			<div class="input-group-append">
                                
				<span class="input-group-text"><i class="fas fa-hashtag"></i></span>
			</div>

            <input type="number" name="vrata" class="form-control" placeholder="Broj vrata" step="1" min="1" max="6" size="3">
            </div>
            </div>



            <div class="col-md-6">
            <label for="sedista">Broj sedišta</label>

            <div class="input-group mb-3">
                            
			<div class="input-group-append">
                                
				<span class="input-group-text"><i class="fas fa-hashtag"></i></span>
			</div>

            <input type="number"  min="1" max="12" name="sedista" placeholder="Broj sedišta" class="form-control" size="8">
            </div>
            </div>
            </div>
            <div class = "form-group text-center">
            <label for="sedista">Dodatne informacije o automobilu</label>

            <div class="input-group mb-3">
                            
			<div class="input-group-append">
                                
				<span class="input-group-text"><i class="fas fa-comment"></i></span>
		    </div>

            <textarea name="komentar" id="komentar" cols="70" rows="10" min-rows = "5" placeholder="Uneti snagu, stanje automobila itd..."></textarea>
            </div>
            </div>





            <div class="row text-center m-6">
            
            <div class="col-md-6">
            <label for="cena">Cena</label>

            <div class="input-group m-6">
                            
			<div class="input-group-append">
                                
				<span class="input-group-text"><i class="fas fa-money-bill"></i></span>
		    </div>

            <input type="number"  min="1" max="1000000" name="cena" placeholder="Cena u evrima" class="form-control" size="4">
            <div class="input-group-append">
                                
				<span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
		    </div>
            </div>
            </div>
            </div>

            <div class="form-group text-center" >
            

                <input class="btn btn-danger m-5 text-center" style="color:#f1f1f1;background-color:#c0392b;" id="changer"  name="dodajauto" type="submit" id="button-addon1" value="Dodaj oglas" disabled>
                <br>
                <small id="checkUsername"></small>
                            </div>
            </form>
    </div>

				

    </div>
        





    </body>
</html>