<?php 
include "navbar.php";
if (!checkIfLogged()){
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="listingstyle.css">
    <title>Početna strana</title>
</head>
<body>
<div class="productsList">
        <div class="product">
        <div style="display:inline-block">
            <div class="productImage"><img src="imgs/logo.png" alt="neki auto" width="150px" height="150px"></div>
            <h4  style='float:right'>Naslov</h4>
            <p  >Opis</p>
            </div>
            <div class="specs"></div>
        
        </div>
        <div class="product">
        <div style="display:inline-block">
            <div class="productImage"><img src="imgs/logo.png" alt="neki auto" width="150px" height="150px"></div>
            <h4  style='float:right'>Naslov</h4>
            <p  >Opis</p>
            </div>
            <div class="specs"></div>
        
        </div>

        <div class="product">
        <div style="display:inline-block">
            <div class="productImage"><img src="imgs/logo.png" alt="neki auto" width="150px" height="150px"></div>
            <h4  style='float:right'>Naslov</h4>
            <p  >Opis</p>
            </div>
            <div class="specs"></div>
        
        </div>

        <div class="product">
        <div style="display:inline-block">
            <div class="productImage"><img src="imgs/logo.png" alt="neki auto" width="150px" height="150px"></div>
            <h4  style='float:right'>Naslov</h4>
            <p  >Opis</p>
            </div>
            <div class="specs"></div>
        
        </div>

        <div class="product">
        <div style="display:inline-block">
            <div class="productImage"><img src="imgs/logo.png" alt="neki auto" width="150px" height="150px"></div>
            <h4  style='float:right'>Naslov</h4>
            <p  >Opis</p>
            </div>
            <div class="specs"></div>
        
        </div>
</body>
</html>

