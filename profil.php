<?php

include "navbar.php";
if (!checkIfLogged()){
    header("location:login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<script>
$.get("https://ipinfo.io", function (response) {    //ne radi, popravi!
    $("#address").html("Awesome " + response.city);
}, "jsonp");
</script>



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"/>
    <link rel="stylesheet" href="general.css"/>
    <link rel="stylesheet" href="forms.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"/>

    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="d-flex justify-content-center form_container" style="margin: 5% 25% !important;padding:5%;background-color:#EB6440;">
    <form method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="<?php echo $_SESSION['username']?>">
                        </div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-inbox"></i></span>
							</div>
							<input type="email" name="email" size="30" class="form-control input_pass" value="<?php echo $_SESSION['email'] ?>">
                        </div>
                        <div class="input-group mb-3">
                        <div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-signature"></i></span>
							</div>
							<input type="text" name="full_name" class="form-control input_pass" value="<?php echo $_SESSION['full_name'] ?>" placeholder="Puno ime">
                        </div>

                        <div class="input-group mb-3">
                        <div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-location"></i></span>
							</div>
                            <div>City: <span id="address"></span></div>
</div>


                <input class="btn btn-danger" style="color:#f1f1f1;background-color:#c0392b"  name="promeniatr" type="submit" id="button-addon1" value="Promeni">
					</form>
</div>
    </div>
</body>
</html>