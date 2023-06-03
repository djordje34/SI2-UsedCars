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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="general.css"/>
    <link rel="stylesheet" href="forms.css"/>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"/>
    <script src="script.js"></script>
<style>

    span{
        width:100%;
    }
</style>
    </head>
    <body>
      
    <div class="container d-flex">
<?php

#NADJI ROW COUNT ZA PRIKAZ KOJA SLIKA JE NA REDU, POMERI U STRANU I ISPISI SA STRANE INFO O AUTU
echo 
"<div id='carouselExampleIndicators' class='carousel slide w-50 h-50 d-inline-block' data-ride='carousel'> 

<div class='carousel-inner'>";
$id = $_GET['id'];

$result = KompletanAuto::getImagesFromID($id);

if ($result->num_rows > 0) {
    $checker = 1;
    $num = 1;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $pctg = round($num / $result->num_rows, 2) * 100;
        if(!$row['img']){
          $row['img'] = 'logo.png';
        }
        echo "
  <div class='carousel-item".str_repeat(' active',$checker)."' id = 'prikaz".$row['img_id']."' name = 'prikaz".$row['img_id']."'>
  <a href='slike/".$row['img']."' >
    <img class='d-block ' src='slike/".$row['img']."' alt='".$row['img_id']."slide' height='480px' width='640px'>
    </a>
    <label for='prikaz".$row['img_id']."' style = 'background:linear-gradient(to right, #EB6440 ".$pctg."%, white ".(100-$pctg)."%);'>".$num."/".$result->num_rows." </label>
  </div>";
        $checker = 0;
        $num += 1;
    }
}
else{
  echo "
  <div class='carousel-item active' id = 'prikaz' name = 'prikaz'>
  <a href='slike/logo'>
    <img class='d-block' src='slike/logo.png' alt='slide' height='480px' width='640px'>
    </a>
    <label for='prikaz'>Oglas nema slika.</label>
  </div>
  ";
}
$auto = KompletanAuto::readFromDB($id,2);
echo "
</div>
<a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
<span class='carousel-control-prev-icon' aria-hidden='true'></span>
<span class='sr-only'>Previous</span>
</a>
<a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
<span class='carousel-control-next-icon' aria-hidden='true'></span>
<span class='sr-only'>Next</span>
</a>
</div>

<div class = 'd-flex flex-column'> 

<span><h5 style = 'display:inline;'>".$auto[13]." ".$auto[14]."(".$auto[4].")"."</h5> <h4 style='color:rgba(235, 100, 64, 0.9);display:inline'>".KompletanAuto::getCenaFromID($id)." € </h4></span>
<div class='d-flex flex-row'>
<div class='d-flex flex-column'>
    <div class='row-md-6'>

                    <table class='table table-striped'>
                    <colgroup>
                    <col class='' style='' />
                    <col class='' style='background-color:rgba(235, 100, 64, 0.8);'/>
                  </colgroup>
  <tbody>
    <tr>
      <td>Gorivo: </td>
      <td>".$auto[2]."</td>
      </tr>
      <tr>
      <td>Kilometraža: </td>
      <td>".$auto[3]." km</td>
      </tr>
      <tr>
      <td>Menjač: </td>
      <td>".$auto[5]."</td>
      </tr>
      <tr>
      <td>Broj vrata: </td>
      <td>".$auto[9]."</td>
      </tr>
      <tr>
      <td>Karoserija: </td>
      <td>".$auto[17]."</td>
      </tr>
      
    
  </tbody>
</table>
</div>

</div>



<div class='d-flex flex-column'>
    <div class='row-md-6'>

                    <table class='table table-striped'>
                    <colgroup>
                    <col class='' style='' />
                    <col class='' style='background-color:rgba(235, 100, 64, 0.8);'/>
                  </colgroup>
  <tbody>
  <tr>
  <td>Kubikaža motora: </td>
  <td>".$auto[8]."</td>
</tr>
<tr>
  <td>Boja: </td>
  <td>".$auto[16]."</td>
</tr>
<tr>
  <td>Broj sedišta: </td>
  <td>".$auto[12]."</td>
</tr>
<tr>
<td>Registrovan? </td>
<td>".$auto[11]."</td>
</tr>
<tr>
<td>Godište: </td>
<td>".$auto[4]."</td>
</tr>


    
  </tbody>
</table>
</div>

</div>

</div>
<div class='d-flex flex-column'>
<label class = 'mb-0'for='kom'>Komentar prodavca</label>
<textarea class='form-control' id='exampleFormControlTextarea1' name='kom' style='min-width: 100%;resize:none' rows='7' disabled>".$auto[7]."</textarea>

</div>
</div>

";
$sellerId = KompletanAuto::getSellerFromCarID($id);

$seller = Customer::generateFromID($sellerId);
echo "</div>
<div class = 'd-flex container text-center justify-content-center' >


<table class='table table-striped w-50 text-center'>
                    <colgroup>
                    <col class='' style='' />
                    <col class='' style='background-color:rgba(235, 100, 64, 0.8);'/>
                  </colgroup>
  <tbody>
  <tr>
  <td>Ime prodavca: </td>
  <td>".$seller->getFullName()."</td>
  </tr>
  <tr>
  <td>Oblast: </td>
  <td>".$seller->getLocation()."</td>
  </tr>
  <tr>
  <td>Kontakt telefon:</td>
  <td>".$seller->getPhoneNumber()."</td>
</tr>


  </tbody>
</table>


</div> 
";
 if(KompletanAuto::checkIfInWaitlist($_GET['id'])){
  echo "<h4 class='text-center' style='color:#c0392b'>
  Ovaj oglas se neće prikazivati korisnicima jer još uvek nije odobren.</h4>";
  }
?>

</div>



</body>
</html>