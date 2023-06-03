<?php 
include 'navbar.php';

if (checkIfLogged()){
    header("location:index.php");
}

?>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>


<script>

$(document).ready(function(){

$("#username").keyup(function(){

   var username = $(this).val().trim();
 console.log(username);
   if(username != ''){

	  $.ajax({
		 url: 'server.php',
		 type: 'post',
		 data: {usernameChecker: username},
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

	<title>Udomi Auto</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="forms.css">
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="imgs/logo.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="POST">

                    <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="email" name="email" class="form-control input_user" value="" placeholder="Vaša e-mail adresa">
						</div>



						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" id="username" name="username" class="form-control input_user" value="" placeholder="Korisničko ime">
							<span id="uname_response"></span>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" title="Minimum 8 karaktera i barem jedan broj" value="" placeholder="Lozinka">
                            
						</div>


						
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<input type="submit" name="register" id="changer" class="btn login_btn" value="Registracija">
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Imate nalog? <a href="login.php" class="ml-2">Ulogujte se</a>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>