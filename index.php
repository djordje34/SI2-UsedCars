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
    <label for="godauta" >Marka automobila</label>
    <div class="input-group mb-3">
    <div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-car"></i></span>
							</div>
							<select id="brend" name="brendS" class="form-select input_user">
                            <?php
                            $res=getBrands();
                            $check=1;
                            $arr = KompletanAuto::getSearchHistory();
                            echo "ovo je array";
                            var_dump($arr);
                            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                                ?>
                                <option value="<?php echo $row['brand_id'];
                                echo "\"";
                                if($row['brand_id']==$arr[0]){
                                    echo " selected";
                                    $check = 0;
                                }
                                ?>><?php echo $row['name'] ?></option>
                                
                                <?php

                              }

                              echo '<option value=\'Svejedno\' '.str_repeat('selected',$check).'>Svejedno</option>';
                            ?>
                            </select>
                        </div>

    </div>

    <div class="col">
    <label for="model" >Model automobila</label>
          <div class="input-group mb-3">
    <div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-font"></i></span>
							</div>
                            
							<input type="text" size="22" name="modelS" minlength="1" id="model" class="form-control input_user" value = "<?php echo $arr['1'] ?>" placeholder="Unesite model automobila">

                            </div>
                            </div>
    <div class="col">
      
                              <div class='row'>
    <label for="oddo" >Raspon godina proizvodnje</label>

<div class="input-group mb-3">

<div class="input-group-append" id='oddo'>
    
    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
</div>

<input type="number" name="odgodauta" id="odgodauta" min="1960" max="2023" step="1" value = "<?php if ($arr[2])
    echo $arr['2'];
else
    echo "1995";?>" class="form-control input_user"/>
<input type="number" name="dogodauta" id="dogodauta" min="1960" max="2023" step="1" value = "<?php if ($arr[3])
    echo $arr['3'];
else
    echo "2023";
    ?>"class="form-control input_user"/>


    </div>
                            </div>
                            </div>
                            <div class="col">
    <label for="kilometraza">Kilometraža manja od</label>

<div class="input-group mb-3">
                
                <div class="input-group-append">
                    
                    <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
                </div>

<input type="number"  min="0" max="2000000" value='500000' name="kilometrazaS" class="form-control" value = "<?php echo $arr['4'] ?>" placeholder="Kilometraža" size="8">
</div>
    </div>

    

    </div>
    <div class='row'>
<div class='col'>
<label for="gorivo">Gorivo</label>

<div class="input-group mb-3">
                
                <div class="input-group-append">
                    
                    <span class="input-group-text"><i class="fas fa-gas-pump"></i></span>
                </div>

    <select id="gorivo" name="gorivoS" class="form-select input_user">
    <option value="Benzin"  <?php if('Benzin'==$arr[5]) echo 'selected' ?>>Benzin</option>
    <option value="Dizel" <?php if('Dizel'==$arr[5]) echo 'selected' ?>>Dizel</option>
    <option value="Benzin+Gas (TNG)" <?php if('Benzin+Gas (TNG)'==$arr[5]) echo 'selected' ?>>Benzin+Gas (TNG)</option>
    <option value="Benzin+Metan (CNG)" <?php if('Benzin+Metan (CNG)'==$arr[5]) echo 'selected' ?>>Benzin+Gas (CNG)</option>
    <option value="Električni pogon" <?php if('Električni pogon'==$arr[5]) echo 'selected' ?>>Električni pogon</option>
    <option value="Hibridni pogon" <?php if('Hibridni pogon'==$arr[5]) echo 'selected' ?>>Hibridni pogon</option>
    <option value="" <?php if(''==$arr[5]) echo 'selected' ?>>Svejedno</option>
</select>
</div>
</div>
<div class='col'>
<label for="menjac">Tip menjača</label>


<div class="input-group mb-3">
                
                <div class="input-group-append">
                    
                    <span class="input-group-text"><i class="fas fa-bolt"></i></span>
                </div>
    <select id="menjac" name="menjacS" class="form-select input_user">
    <option value="Manuelni 4 brzine" <?php if('Manuelni 4 brzine'==$arr[6]) echo 'selected' ?>>Manuelni 4 brzine</option>
    <option value="Manuelni 5 brzina" <?php if('Manuelni 5 brzina'==$arr[6]) echo 'selected' ?>>Manuelni 5 brzina</option>
    <option value="Manuelni 6 brzina" <?php if('Manuelni 6 brzina'==$arr[6]) echo 'selected' ?>>Manuelni 6 brzina</option>
    <option value="Poluautomatski" <?php if('Poluautomatski'==$arr[6]) echo 'selected' ?>>Poluautomatski</option>
    <option value="Automatski" <?php if('Automatski'==$arr[6]) echo 'selected' ?>>Automatski</option>
    <option value="" <?php if(''==$arr[6]) echo 'selected' ?>>Svejedno</option>
    </select>
</div>



</div>
<div class='col'>
<label for="boje">Boja automobila</label>

<div class="input-group mb-3">
                
                <div class="input-group-append">
                    
                    <span class="input-group-text"><i class="fas fa-palette"></i></span>
                </div>

<select id="boje" name="bojeS" class="form-select input_user">
                <?php
                $res=getColors();
                while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                    ?>
                    <?php
                    
                    #$enc=mb_detect_encoding($row["boja_id"]);
                    #$fix=mb_convert_encoding($row["name"], $enc, 'windows-1252');
                    #$fix = $row['name'];
                    //$fix=iconv($enc, 'UTF-8',$row['name']);
                    #echo $row['name'] ."\" ";
                    #if($row['name']==$arr[0]){
                        #echo " selected>";
                    #}
                     #$fix ?>
                     <option value="<?php echo $row['name'];
                     echo "\"";
                                if($row['name']==$arr[7]){
                                    echo " selected";
                                }
                                ?>><?php echo $row['name'] ?>
                                </option>
                    <?php
                  }
                ?>
                <option value="" <?php if($arr[7]=='') echo 'selected' ?>>Svejedno</option>
                </select>

</div>
</div>
<div class='col'>
<label for="registracija">Registrovan?</label>

<div class="input-group mb-3">
                
<div class="input-group-append">
                    
    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
</div>

<select id="registracija" name="registracijaS" class="form-select input_user">
    <option value="Da" <?php if($arr[8]=='Da') echo 'selected' ?>>Da</option>
    <option value="Ne" <?php if($arr[8]=='Ne') echo 'selected' ?>>Ne</option>
    <option value="" <?php if($arr[8]=='') echo 'selected' ?>>Svejedno</option>

    </select>
</div>
</div>

    </div>
    <div class='row'>
    
    <div class='col'>
    <label for="cenaod">Cena od</label>

<div class="input-group m-6">
                
<div class="input-group-append">
                    
    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
</div>

<input type="number"  min="1" max="1000000" name="cenaod" placeholder="Cena u evrima" value="<?php echo $arr[9]?>" class="form-control" size="4">
<div class="input-group-append">
                    
    <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
</div>
</div>
    </div>
    <div class='col'>
    <label for="cenado">Cena do</label>

<div class="input-group m-6">
                
<div class="input-group-append">
                    
    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
</div>

<input type="number"  min="1" max="1000000" name="cenado" value="<?php echo $arr[10]?>" placeholder="Cena u evrima" class="form-control" size="4">
<div class="input-group-append">
                    
    <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
</div>
</div>
    </div>
    <div class='col'>
    </div>
    </div>
    <div class='row my-5'>
<div class='col'>

    <div class="form-check">
  <input class="form-check-input" type="radio" name="po_cemu" id="exampleRadios1" value=" ORDER BY CONVERT(cis.price,SIGNED)" <?php if($arr[12]==" ORDER BY CONVERT(cis.price,SIGNED)") echo "checked";
  else if(!$arr[12]){
      echo "checked";
  } ?>>
  <label class="form-check-label float-left" for="exampleRadios1">
    Po ceni
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="po_cemu" id="exampleRadios2" value=" ORDER BY CONVERT(cin.year,SIGNED)" <?php if($arr[12]==" ORDER BY CONVERT(cin.year,SIGNED)") echo "checked"; ?>>
  <label class="form-check-label float-left" for="exampleRadios2">
    Po godištu
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="po_cemu" id="exampleRadios3" value=" ORDER BY CONVERT(cin.mileage,SIGNED)" <?php if($arr[12]==" ORDER BY CONVERT(cin.mileage,SIGNED)") echo "checked"; ?>>
  <label class="form-check-label float-left" for="exampleRadios3">
    Po kilometraži
  </label>
</div>





                </div>


                <div class='col'>
                <div class="form-check">
  <input class="form-check-input" type="radio" name="kako" id="exampleRadios1" value=" ASC" <?php if
  ($arr[13] == " ASC") {
      $switch = 0;
      echo "checked";
  }
  else
      $switch = 1;

   ?>>
  <label for="exampleRadios1">
            <img src="https://static.thenounproject.com/png/1624632-200.png" alt="Image 1" style='width:25px;height:25px;float:left;background-color:#c0392b;transform:rotate(180deg)'>Od manjeg ka većem</label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="kako" id="exampleRadios2" value=" DESC" <?php if ($arr[13] == " DESC")
      echo "checked";
  else if ($switch) {
      echo "checked";
  }?>>
  <label for="exampleRadios2">
            <img src="https://static.thenounproject.com/png/1624633-200.png" alt="Image 2" style='width:25px;height:25px;float:left;background-color:#c0392b;transform:scaleX(-1)'>Od većeg ka manjem</label>
</div>
                </div>
                
                <div class='col'></div><div class='col'></div><div class='col'></div><div class='col'></div><div class='col'></div>

              
    </div>
    <div class='row'>

    <div class='col'>
    </div>
    <div class='col d-flex justify-content-center'>
        <input type="button" value="Pretraži" name='pretrazi' id='pretraziOglaseParams' class='btn btn-danger my-3'>
    </div>
    <div class='col'>
        
    </div>
    </div>
    </form>
    </div>
        <div id='ovde' class=''>


        </div>
        <div class="Page navigation example d-flex justify-content-center " style='width:100%'>
            <ul class="pagination d-flex justify-content-around">
                <li class='page-item'>
                    <input type='submit' class='prethodnastrana btn btn-dark my-3' name = 'prethodna' value='Prethodna strana'>
            </li> 
            <li class='page-item mx-5 align-self-center'>
                <div class='d-flex d-column'>
                <p class='pageShow' style='margin:0;font-size:xx-large;color:#343A40;'>0</p>
                <p class='' style='margin:0;font-size:xx-large;color:#343A40;'>/</p>
                <p name="odkoliko" style='margin:0;font-size:xx-large;color:#343A40;'></p>
                </div>
                </li>
            <li class="page-item">
                    <input class="sledecastrana btn btn-dark my-3" type='submit' name = 'sledeca' value='Sledeća strana'>
                </li>
                </ul> 
                </div>

    </div>
    <script>
    $(document).ready(function(){
        $("#pretraziOglaseParams").trigger('click'); 

});



</script>



</body>
</html>

