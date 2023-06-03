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



    <style>
    .form-check-input:checked {
    background-color: #c0392b;
    border-color: #c0392b;
}
    </style>
    </head>
    <body>

    <div class="container">
        

        <div class="d-flex justify-content-center form_container" style="margin: 0 25% !important;padding:5%;background-color:#EB6440;">
        <form method="POST" autocomplete="off" id="specs">


        <div class="row">
        <div class="col-md-6">
            <label for="motor">Kubikaža motora</label>
            <input type="number" name="motor" class="form-control" step="1" min="200" max="6000" placeholder="Motor" size="8">
            </div>

            <div class="col-md-6">
            <label for="kilometraza">Kilometraža</label>
            <input type="number"  min="0" max="2000000" name="kilometraza" class="form-control" placeholder="Kilometraža" size="8">
            </div>


            </div>

            <div class="form-group">
            <label for="gorivo">Gorivo</label>
                <select id="gorivo" name="gorivo" class="form-select input_user">
                <option value="Benzin">Benzin</option>
                <option value="Dizel">Dizel</option>
                <option value="Benzin+Gas (TNG)">Benzin+Gas (TNG)</option>
                <option value="Benzin+Metan (CNG)">Benzin+Gas (CNG)</option>
                <option value="Električni pogon">Električni pogon</option>
                <option value="Hibridni pogon">Hibridni pogon</option>
            </select>
            </div>
       
            <div class="form-group">
            <label for="menjac">Tip menjača</label>
                <select id="menjac" name="menjac" class="form-select input_user">
                <option value="Manuelni 4 brzine">Manuelni 4 brzine</option>
                <option value="Manuelni 5 brzina">Manuelni 5 brzina</option>
                <option value="Manuelni 6 brzina">Manuelni 6 brzina</option>
                <option value="Poluautomatski">Poluautomatski</option>
                <option value="Automatski">Automatski</option>
                </select>
            </div>
            <div class="form-group">
            <label for="boje">Boja automobila</label>
            <select id="boje" name="boje" class="form-select input_user">
                            <?php
                            $res=getColors();
                            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                ?>
                                <option value="<?php
                                $enc=mb_detect_encoding($row["name"]);
                                $fix=mb_convert_encoding($row["name"], $enc, 'windows-1252');
                                //$fix=iconv($enc, 'UTF-8',$row['name']);
                                echo $row['boja_id'] ."\">" . $fix ?></option>
                                <?php
                              }
                            ?>
                            </select>

            </div>

            <div class="form-group">

                            <label for="godauta" >Godina proizvodnje</label>
                         <input type="number" name="godauta" id="godauta" min="1960" max="2023" step="1" value="2010" class="form-control input_user"/>
                         

            </div>
            <div class="row">
        <div class="col-md-6">
            <label for="vrata">Broj vrata</label>
            <input type="number" name="vrata" class="form-control" placeholder="Broj vrata" step="1" min="1" max="6" size="3">
            </div>




            <div class="col-md-6">
            <label for="sedista">Broj sedišta</label>
            <input type="number"  min="1" max="12" name="sedista" placeholder="Broj sedišta" class="form-control" size="8">
            </div>
            </div>

            <div class="form-group" style="margin-top:15%;">
        <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDanger">
  <label class="form-check-label" for="flexSwitchCheckDanger" style="float:left;">Važeća registracija</label>
</div>

                            </div>
        </form>
        </div>
</div>




    </body>
</html>