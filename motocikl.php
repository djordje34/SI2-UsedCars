<?php 
include "navbar.php";
if($_SESSION){
    if($_SESSION['role']){
    header('location:administration.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
       
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"/>

    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="listingstyle.css">
    <script src="script.js"></script>
    
    <title>Početna strana</title>
</head>
<body>
<div class= ''>
    <div id = 'searchHolder' class='d-flex justify-content-center w-75 mx-auto shadow-lg p-3 mb-5 bg-body-tertiary rounded'>
    <form  class='mb-0' >
    <div class="row">
    <div class="col">
    <label for="markaM" >Marka motocikla</label>
    <div class="input-group mb-3">
    <div class="input-group-append">
    <input type="text" size="22" name="markaM" minlength="1" id="markaM" class="form-control input_user"  placeholder="Unesite marku motocikla">
            
                        </div>

    </div>

    <div class="col">
    <label for="model" >Model motocikla</label>
          <div class="input-group mb-3">
    <div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-font"></i></span>
							</div>
                            
							<input type="text" size="22" name="modelM" minlength="1" id="modelM" class="form-control input_user" placeholder="Unesite model motocikla">

                            </div>
                            </div>
    <div class="col">
      
                              <div class='row'>
    <label for="tipM" >Tip</label>

<div class="input-group mb-3">

<div class="input-group-append" id='oddo'>
    
    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
</div>

<select id="tipM" name="tipM" class="form-select input_user">
    <option value="Tip1"  >Tip1</option>
    <option value="Tip2" >Tip2</option>
    <option value="Benzin+Gas (TNG)" >Benzin+Gas (TNG)</option>
    <option value="Motokros" >Motocross</option>
    <option value="Enduro" >Enduro</option>

</select>


    </div>
                            </div>
                            </div>
                           
                            <div class='row'>

<div class='col'>
</div>
<div class='col d-flex justify-content-center'>
    <input type="button" value="Pretraži" name='pretraziM' id='pretraziM' class='btn btn-danger my-3'>
</div>
<div class='col'>
    
</div>
</div>
    </div>
    </form>
    </div>
</div>
        <div id='ovde' class=''>


        </div>
    

    </div>

</body>
</html>