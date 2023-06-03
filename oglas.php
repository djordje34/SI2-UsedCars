<?php

include "navbar.php";
if (!checkIfLogged()){
    header("location:login.php");
}
if($_SESSION['role']){
  header('location:administration.php');
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"><link rel="stylesheet" href="general.css"/>
    <link rel="stylesheet" href="forms.css"/>
    <link rel="stylesheet" href="listingstyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"/>
    <script src="adModification.js"></script>
    </head>
    <body>

    <div class="container text-center">
      <?php
      $id = $_GET['id'];
      $auto = KompletanAuto::getCarTitleFromID($id);
      $kor_id = KompletanAuto::getSellerFromCarID($id);
      if($_SESSION['id']!=$kor_id){
        header('location:index.php');
      }
      echo "<h5>" . $auto[0] . " " . $auto[1] . "(" . $auto[2] . ")" . "</h5>";
    echo "<button type='submit' class = 'btn btn-danger btn-sm' name='obrisiOglas' id='obrisiOglas".$id."'>Obriši ovaj oglas</button>";
    ?>
        <div class="d-flex justify-content-center form_container m-5" style="background-color:#EB6440;">
        <div class="row text-center m-6">
        <h5>Dodaj sliku</h5>    
        <form action=<?php echo "'upload.php?id=".$_GET['id']."'" ?> method='POST' enctype="multipart/form-data">
            <div class="input-group m-12">
                            
            
            <input class="form-control" type="file" id="fileToUpload" name="fileToUpload" style='width:50%;'>
            <input class="btn btn-danger" type="submit" value="Upload Image" name="submitImg" style='border:1px solid black;'>
            
            </div>
            </form>
            </div>

</div>

<div class="row d-flex overflow-auto">

  <?php
  $id = $_GET['id'];
  $result = KompletanAuto::getImagesFromID($id);
    
  if ($result->num_rows >= 0) {
      $checker = 1;
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "
        <div class='col-md-2 d-flex flex-column' id = 'prikaz".$row['img_id']."'>

      <a href='slike/".$row['img']."' style='width:200px;height:200px'>
        <img src='slike/".$row['img']."' alt='".$row['img_id']."slide' style='width:200px;height:200px'>
        </a>
        <div class='caption text-center d-block'>
          <button type='submit' name='obrisiSliku' id='".$row['img_id']."' class = 'btn btn-danger btn-sm'>Obriši sliku</button>
        </div>
      
        </div>";
          $checker = 0;
      }
  }
  ?>
  </div>

            
            <div class="d-flex justify-content-center">

            <div class="input-group m-6 text-center justify-content-center w-50">
                            
			<div class="input-group-append">          
				<span class="input-group-text"><i class="fas fa-money-bill"></i></span>
		    </div>
      <div class='w-25'>
            <input type="number"  min="1" max="1000000" name="novaCena" id='novaCena' placeholder="Cena u evrima" class="form-control" size="4" value=<?php echo KompletanAuto::getCenaFromID($id)?>>
            </div>
            <div class="input-group-append">
                                
				<span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
		    </div>
            
            <button type="submit" class = 'btn btn-danger btn-sm' name='promeniCenu' id ='<?php echo $id; ?>'>Promeni cenu</button>
            </div>
            </div>


</div>



    </body>
</html>