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
var string = $('#locs').val(); // What i want to pass to php

 $.ajax({
    type: 'post', // the method (could be GET btw)
    url: 'server.php', // The file where my php code is
    data: {
        'location': string // all variables i want to pass. In this case, only one.
    },

});

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
        <p></p>
    <div class="d-flex justify-content-center form_container" style="margin: 0 25% !important;padding:5%;background-color:#EB6440;">
    <form method="POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
                                
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" id="username" class="form-control input_user" value="<?php echo $_SESSION['username']?>">
                            <span id="uname_response"></span>
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
								<span class="input-group-text"><i class="fas fa-map-pin" aria-hidden="true"></i></span>
							</div>
                            <select id="locs" name="location">
                                <option value="<?php echo $_SESSION['location'] ?>" <?php if ($_SESSION['location']){
                                                                                                        echo "selected>". $_SESSION['location']; 
                                                                                                        }
                                                                                                    else{
                                                                                                        echo "disabled>". "Izaberite grad";
                                                                                                    }
                                                                                        echo "</option>";           
                                ?>
                                
                            <option value="Belgrade">Belgrade</option>
                            <option value="Bor District">Bor District</option>
                            <option value="Braničevo District">Braničevo District</option>
                            <option value="Central Banat District">Central Banat District</option>
                            <option value="Jablanica District">Jablanica District</option>
                            <option value="Kolubara District">Kolubara District</option>
                            <option value="Mačva District">Mačva District</option>
                            <option value="Moravica District">Moravica District</option>
                            <option value="Nišava District">Nišava District</option>
                            <option value="North Bačka District">North Bačka District</option>
                            <option value="North Banat District">North Banat District</option>
                            <option value="Pčinja District">Pčinja District</option>
                            <option value="Pirot District">Pirot District</option>
                            <option value="Podunavlje District">Podunavlje District</option>
                            <option value="Pomoravlje District">Pomoravlje District</option>
                            <option value="Rasina District">Rasina District</option>
                            <option value="Raška District">Raška District</option>
                            <option value="South Bačka District">South Bačka District</option>
                            <option value="South Banat District">South Banat District</option>
                            <option value="Srem District">Srem District</option>
                            <option value="Šumadija District">Šumadija District</option>
                            <option value="Toplica District">Toplica District</option>
                            <option value="Vojvodina">Vojvodina</option>
                            <option value="West Bačka District">West Bačka District</option>
                            <option value="Zaječar District">Zaječar District</option>
                            <option value="Zlatibor District">Zlatibor District</option>
                        </select>
                        <span>Trenutno izabrano: <?php
                            if ($_SESSION['location']){
                        echo $_SESSION['location'];
                            }
                            else{
                                echo "Izaberite grad";
                            }
                        
                        ?></span>
                        </div>

                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-inbox"></i></span>
							</div>
							<input type="tel" name="tel" size="15" class="form-control input_pass" value="<?php echo $_SESSION['tel'] ?>" placeholder="Broj telefona u formatu 06X XXX XXXX" pattern="06[0-9]{1} [0-9]{3} [0-9]{4}">
                        </div>
                        

                <input class="btn btn-danger" style="color:#f1f1f1;background-color:#c0392b"  name="promeniatr" type="submit" id="button-addon1" value="Promeni">
					</form>
    </div>
    </div>
</body>
</html>