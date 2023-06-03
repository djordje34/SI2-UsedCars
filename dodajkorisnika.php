<?php

include "navbar.php";
if (!checkIfLogged()){
    header("location:login.php");
}
if(!$_SESSION['role']){
    header('location:index.php');
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
    <link rel="stylesheet" href="general.css"/>
    <link rel="stylesheet" href="forms.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous"/>

    <title>Document</title>
<script>
    $(document).ready(function(){

$("#username").keyup(function(){

   var username = $(this).val().trim();
 console.log(username);
   if(username != ''){

      $.ajax({
         url: 'server.php',
         type: 'post',
         data: {username: username},
         success: function(response){

             $('#uname_response').html(response);
             
          }
      });
   }else{
      $("#uname_response").html("");
   }

 });

});
</script>

</head>
<body>
    <div class="container">
    <div class="d-flex justify-content-center form_container" style="margin: 0 25% !important;padding:5%;background-color:#EB6440;">
    <form method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" id="username" class="form-control input_user" value="">
                            <span id="uname_response"></span>
                        </div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-inbox"></i></span>
							</div>
							<input type="email" name="email" size="30" class="form-control input_pass" value="">
                        </div>

                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" size="30" class="form-control input_pass" value="">
                        </div>

 
                        

                <input class="btn btn-danger" style="color:#f1f1f1;background-color:#c0392b" id="changer"  name="dodajKorisnika" type="submit" id="button-addon1" value="Dodaj korisnika">
					</form>
    </div>
    </div>
</body>
</html>