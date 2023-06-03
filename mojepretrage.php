<?php 
include "navbar.php";
if (!checkIfLogged()){
    header("location:login.php");
}
if($_SESSION['role']){
    header("location:administration.php");
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
    <script src="pretrage.js"></script>
    
    <title>Pretrage</title>
</head>
<body>
<div class='d-flex justify-content-center w-75 mx-auto shadow-lg p-3 mb-5 bg-body-tertiary rounded'>
<div class="d-flex flex-column">
<h3>Sačuvane pretrage</h3>
<button class='btn btn-danger my-3 skriven' style='display:none'>Prikaži</button>

<div id = 'printOvde'>


</div>
</div>
</div>
<script>
$(document).ready(function(){
        $(".skriven").trigger('click'); 
        console.log("klik")

});


</script>
</body>
</html>