
<?php 
include "navbar.php";
if (!checkIfLogged()){
    header("location:login.php");
}
if(!$_SESSION['role']){
    header("location:login.php");
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
    <script src="adminScript.js"></script>
    
    <title>Administrativni panel</title>
</head>
<body>
<div class='d-flex justify-content-center w-75 mx-auto shadow-lg p-3 mb-5 bg-body-tertiary rounded'>
<div class="d-flex flex-column">
<h3>Administrativni panel</h3>
<div class='d-flex justify-content-center m-5'>

<select id="adminIzbor" name="adminIzbor" class="form-select input_user">
    <option value="Korisnici">Korisnici</option>
    <option value="Odobreni oglasi" >Odobreni oglasi</option>
    <option value="Neodobreni oglasi" >Neodobreni oglasi</option>

</select>
</div>

<div id = 'printOvde'>


</div>
</div>
</div>
<script>



</script>
</body>
</html>