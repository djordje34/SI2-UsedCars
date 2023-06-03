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
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"/>
    <link rel="stylesheet" href="general.css"/>
    <link rel="stylesheet" href="forms.css"/>
    <link rel="stylesheet" href="listingstyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"/>
    <script src="script.js"></script>
    </head>
    <body>
    <div class="container">
        
    <button name = "korisnikoglasi" class="btn btn-danger redirecter" onclick="window.location.href='dodajoglas.php'">Dodaj novi oglas</button>
				

    </div>
        

    <div>
        <?php 
     $id = $_SESSION["id"];
     $db1 = mysqli_stmt_init(KompletanAuto::connectToDB());
     $result = KompletanAuto::getAdsFromUserId($id);
     echo "<div class='container mt-5 mb-5'>
     <div class='d-flex justify-content-center row'>
         <div class='col-md-10'>";
        if ($result->num_rows >= 0) {
            #mysqli_stmt_fetch($db1);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $auto = KompletanAuto::readFromDB($row['Cars_instance_i_id'],2);
                $slika = KompletanAuto::GetFirstImg($row['Cars_instance_i_id']);
                if (!$slika)
                    $slika = 'logo.png';
                echo " <div class='row p-2 bg-white border rounded'>
                <div class='col-md-3 mt-1'><img class='img-fluid img-responsive rounded product-image' src='slike/".$slika."' style='width:200px;height:200px;'></div>
                <div class='col-md-6 mt-1'>
                    <h5>".$auto[13]." ".$auto[14]."(".$auto[4].")"."</h5>
                    <div class='d-flex flex-row'>
                        
                    </div>
                    <div class='mt-1 mb-1 spec-1'> <span>Kubikaža motora: ".$auto[8]."</span>
                    <span>Gorivo: ".$auto[2]."</span>
                    <span>Kilometraža: ".$auto[3]." km</span>
                    <span>Menjač: ".$auto[5]."</span>
                    <span>Broj vrata: ".$auto[9]."</span>
                    <span>Karoserija: ".$auto[17]."</span>
                </div>
                </div>
                <div class='align-items-center align-content-center col-md-3 border-left mt-1'>
                    <div class='d-flex flex-row align-items-center'>
                        <h4 class='mr-1'>".$row['price']."€</h4>
                    </div>
                    <div class='d-flex flex-column mt-4'>
                    <input class='btn btn-danger btn-sm' id='".$row['Cars_instance_i_id']."' name='contact' type='submit' value='Prikaži kontakt'>
                    </div>
                    
                    <div style='font-size:12;' id ='show_contact".$row['Cars_instance_i_id']."'></div>
                    
                    <div style='font-size:16;color:#c0392b'>";
                    if(KompletanAuto::checkIfInWaitlist($row['Cars_instance_i_id'])){
                    echo "Ovaj oglas se neće prikazivati korisnicima jer još uvek nije odobren.";
                    }
                   echo "</div>
                </div>
                <div class='d-grid gap-2 col-6 mx-auto'>
                <button type='submit' class='btn btn-danger btn-sm' name='izmeniOglas' id='izmeni".$row['Cars_instance_i_id']."'> Postavke oglasa</button>
                </div>
            </div>
            
            
            ";

            }
        }
        echo "
        </div>
    </div>
</div>
        
        ";
        ?>
    </div>



    </body>
</html>