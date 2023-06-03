<?php
include_once 'customer.php';
include_once 'optAuto.php';
include_once 'admin.php';
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$err="";
$errors = array();
$userPage = 0;
// Create connection
$db = mysqli_connect('localhost', 'root','', 'mydb');
// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



function getColors(){
  $db = mysqli_connect('localhost', 'root','', 'mydb');
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT boja_id,name FROM boja");
  mysqli_stmt_execute($db1);
  $allcolors=mysqli_stmt_get_result($db1);
  mysqli_stmt_fetch($db1);
  return $allcolors;
}

function getTypes(){
  $db = mysqli_connect('localhost', 'root','', 'mydb');
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT body_id,type FROM body");
  mysqli_stmt_execute($db1);
  $alltypes=mysqli_stmt_get_result($db1);
  mysqli_stmt_fetch($db1);
  return $alltypes;
}

function getBrands(){
  $db = mysqli_connect('localhost', 'root','', 'mydb');
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT brand_id,name FROM brands");
  mysqli_stmt_execute($db1);
  $allbrands=mysqli_stmt_get_result($db1);
  mysqli_stmt_fetch($db1);
  return $allbrands;
}

function checkIfLogged(){
  if (!$_SESSION){
    return false;
  }
  return $_SESSION['loggedin'];
}

function get_user_ID($korisnik)
{
  $id_user='';
  $db = mysqli_connect('localhost', 'root','', 'mydb');
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT u_id FROM user WHERE username=?");
  mysqli_stmt_bind_param($db1, "s", $korisnik);
  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $id_user);
  mysqli_stmt_fetch($db1);
  return $id_user;
}

function check_if_username_in($username,$id){ //U KLASU KORISNIK!!!
  if( $id!=-1){

  $db = mysqli_connect('localhost', 'root','', 'mydb');
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT u_id FROM user WHERE username=? AND u_id!=?");
  mysqli_stmt_bind_param($db1, "si", $username,$id);
  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $id_user);
  mysqli_stmt_fetch($db1);

  }
  else{
    $db = mysqli_connect('localhost', 'root','', 'mydb');
    $db1=mysqli_stmt_init($db);
    mysqli_stmt_prepare($db1, "SELECT u_id FROM user WHERE username=?");
    mysqli_stmt_bind_param($db1, "s", $username);
  }

  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $id_user);
  mysqli_stmt_fetch($db1);
  if ($id_user){
    return true;
  }
  else{
    return false;
  }

}

if (isset($_POST['unesiNovuPretragu'])) {
  $params[0]=mysqli_real_escape_string($db,$_POST['brendS']);
  $params[1]=mysqli_real_escape_string($db,$_POST['modelS']);
  $params[2]=mysqli_real_escape_string($db,$_POST['odgodauta']);
  $params[3]=mysqli_real_escape_string($db,$_POST['dogodauta']);
  $params[4]=mysqli_real_escape_string($db,$_POST['kilometrazaS']);
  $params[5]=mysqli_real_escape_string($db,$_POST['gorivoS']);
  $params[6]=mysqli_real_escape_string($db,$_POST['menjacS']);
  $params[7]=mysqli_real_escape_string($db,$_POST['bojeS']);
  $params[8]=mysqli_real_escape_string($db,$_POST['registracijaS']);
  $params[9]=mysqli_real_escape_string($db,$_POST['cenaod']);
  $params[10]=mysqli_real_escape_string($db,$_POST['cenado']);
  $params[11] = mysqli_real_escape_string($db,$_POST['po_cemu']);
  $params[12] = mysqli_real_escape_string($db,$_POST['kako']);

  $c_id = $_SESSION['id'];
  $vreme = 
      $db1 = mysqli_stmt_init(KompletanAuto::connectToDB());
        mysqli_stmt_prepare($db1, "INSERT INTO pretrage_korisnika (brend,model,odgod,dogod,kilometraza,gorivo,menjac,boje,registracija,cenaod,cenado,vreme,c_id,po_cemu,kako)
         VALUES(?,?,?,?,?,?,?,?,?,?,?,now(),?,?,?)");
        mysqli_stmt_bind_param($db1, "sssssssssssiss",$params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9],$params[10],$c_id,$params[11],$params[12]);
        mysqli_stmt_execute($db1);

        mysqli_stmt_close($db1);
}
if(isset($_POST['pretragaM'])){
  $params[0]=mysqli_real_escape_string($db,$_POST['brendM']);
  $params[1]=mysqli_real_escape_string($db,$_POST['modelM']);
  $params[2]=mysqli_real_escape_string($db,$_POST['tip']);


  $response = KompletanAuto::izlistajMotore($params);
  echo $response;
  return false;

}

if(isset($_POST['pretraga'])){
  $params[0]=mysqli_real_escape_string($db,$_POST['brendS']);
  $params[1]=mysqli_real_escape_string($db,$_POST['modelS']);
  $params[2]=mysqli_real_escape_string($db,$_POST['odgodauta']);
  $params[3]=mysqli_real_escape_string($db,$_POST['dogodauta']);
  $params[4]=mysqli_real_escape_string($db,$_POST['kilometrazaS']);
  $params[5]=mysqli_real_escape_string($db,$_POST['gorivoS']);
  $params[6]=mysqli_real_escape_string($db,$_POST['menjacS']);
  $params[7]=mysqli_real_escape_string($db,$_POST['bojeS']);
  $params[8]=mysqli_real_escape_string($db,$_POST['registracijaS']);
  $params[9]=mysqli_real_escape_string($db,$_POST['cenaod']);
  $params[10]=mysqli_real_escape_string($db,$_POST['cenado']);
  $params[11] = mysqli_real_escape_string($db,$_POST['po_cemu']);
  $params[12] = mysqli_real_escape_string($db,$_POST['kako']);
  $page = mysqli_real_escape_string($db,$_POST['page']);
  $response = KompletanAuto::izlistajSaParametrima($params,$page);
  echo $response;
  return false;

}


if(isset($_POST['promeniCenu'])){
  $price = $_POST['promeniCenu'];
  $id = $_POST['potrebniID'];
  KompletanAuto::setCenaFromID($id, $price);
  echo "Uspešno promenjena cena.";
}


if (isset($_POST['obrisiOglas'])){
  $imgid = $_POST['obrisiOglas'];
  KompletanAuto::izbrisiAutoiAd($imgid);
  echo "Uspešno obrisan oglas.";
}

if (isset($_POST['obrisiSliku'])){
  $imgid = $_POST['obrisiSliku'];
  KompletanAuto::deleteCarImage($imgid);
  echo "Uspešno obrisana slika.";
}

if (isset($_POST['register']))
{
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);


  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }


  $user = Korisnik::checkIfPossible($username, $email);
  if ($user) // if user exists
  {
    array_push($errors, "Korisničko ime ili e-mail već postoji.");
  }
  
  
  if (count($errors) == 0)
  {
    $hashed_password = password_hash($password,PASSWORD_BCRYPT);//encrypt the password before saving in the database
    
      
      $korisnik = new Customer($username, $email, $password,"","","");
      $korisnik->writeToDB($hashed_password);

  	header('location: login.php');
  }

}

if(isset($_POST["login"])){


    $username = mysqli_real_escape_string($db, $_POST['usernamelog']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($username)) {
        array_push($errors, "Korisničko ime je neophodno!");
    }
    if (empty($password)) {
        array_push($errors, "Lozinka je neophodna!");
    }
  
    if (count($errors) == 0)
    {
      if($username == 'admin'){
      $hpw = Admin::loadPassword();
      if(password_verify($password, $hpw))
      {
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = 'sudo';
        header('location:administration.php');
        $_SESSION['id'] = Admin::loadID();
      }
      }
      else{

    $passworddb = Korisnik::getPWFromUN($username);
  
      if (password_verify($password, $passworddb))
      {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;

        $id = Korisnik::staticGetID($username);
        $_SESSION['id']=$id;
        $korisnik = Customer::generateFromID($id);
        $_SESSION['email']=$korisnik->getEmail();

        $_SESSION['full_name']=$korisnik->getFullName();
        $_SESSION['location']=$korisnik->getLocation();
        $_SESSION['tel']=$korisnik->getPhoneNumber();
        $_SESSION['role'] = false;
        header('location: index.php');
      }
      else
      {
          $err="Pogrešno korisničko ime ili lozinka";
        
      }
    }}}
    
    if(isset($_POST['editAd'])){
      $id = $_POST['editAd'];

      $pr = KompletanAuto::getSellerFromCarID($id);

      echo $pr == $_SESSION['id'];
    }

    if(isset($_POST['contact'])){

      $id = $_POST['contact'];


      $cid = KompletanAuto::getSellerFromCarID($id);

      $kor = Customer::generateFromID($cid);

      $response = "<span>Broj telefona:".$kor->getPhoneNumber()."</span><span>Oblast:".$kor->getLocation()."</span><span>Ime prodavca:".$kor->getFullName()."</span>";
      echo $response;
    }

    if (isset($_POST['usernameChecker'])){
      if (!$_SESSION){
        $guardId=-1;
      }
      else{
        $guardId=$_SESSION['id'];
      }
      $newusername = mysqli_real_escape_string($db, $_POST['usernameChecker']);
      if(Customer::checkIfUsernameAvailable($newusername,$guardId)){
        $response = "<span style='color: red;'>Zauzeto</span><script>$('#changer').attr('disabled', true);</script>";
      }
      else if(strlen(($newusername))<6){
        $response = "<span style='color: red;'>Minimum 6 karaktera</span><script>$('#changer').attr('disabled', true);</script>";
      }
      else{
        $response="<span style='color: green;'>Slobodno</span><script>$('#changer').attr('disabled', false);</script>";
      }

      echo $response;
  }
    if(isset($_POST["promeniatr"])){  #PROVERI DA LI JE ZAUZET USERNAME
      $newusername = mysqli_real_escape_string($db, $_POST['username']);
      $newemail= mysqli_real_escape_string($db, $_POST['email']);
      $newlocation= mysqli_real_escape_string($db, $_POST['location']);
      $newfname= mysqli_real_escape_string($db, $_POST['full_name']);
      $newtel=mysqli_real_escape_string($db, $_POST['tel']);
      $db1=mysqli_stmt_init($db);

      Customer::updateFields($newusername, $newemail, $newfname, $newlocation, $newtel, $_SESSION['id']);

      $_SESSION['username']=$newusername;
      $_SESSION['email']=$newemail;
      $_SESSION['full_name']=$newfname;
      $_SESSION['location']= $newlocation;
      $_SESSION['tel']=$newtel;
      $userPage = 0;
      header("location:profil.php");
    }

    if(isset($_POST["dodajauto"])){

      $carbrand = mysqli_real_escape_string($db, $_POST['brend']);
      $carmodel= mysqli_real_escape_string($db, $_POST['model']);

      $auto = new Auto($carbrand,$carmodel);
      $auto->writeToDB();

      $karoserija= mysqli_real_escape_string($db, $_POST['karoserija']);
      $registracija = mysqli_real_escape_string($db, $_POST['vazecaregistracija']);
      $motor = mysqli_real_escape_string($db, $_POST['motor']);
      $mileage = mysqli_real_escape_string($db, $_POST['kilometraza']);
      $fuel = mysqli_real_escape_string($db, $_POST['gorivo']);
      $transmission = mysqli_real_escape_string($db, $_POST['menjac']);
      $boja_id = intval( mysqli_real_escape_string($db, $_POST['boje']));
      $god= mysqli_real_escape_string($db, $_POST['godauta']);
      $num_doors = mysqli_real_escape_string($db, $_POST['vrata']);
      $num_sed = mysqli_real_escape_string($db, $_POST['sedista']);
      $komentar = mysqli_real_escape_string($db, $_POST['komentar']);
      $body_id =intval( mysqli_real_escape_string($db, $_POST['karoserija']));
      $cena = mysqli_real_escape_string($db, $_POST['cena']);

      $kauto = new KompletanAuto($auto->getBrandID(),$auto->getModel(),$fuel,$mileage,$god,$transmission,$boja_id,
    $komentar,$motor,$num_doors,$body_id,$registracija,$num_sed);

    $kauto->writeToDB();

    $iid = $kauto->getThisID();
    $_SESSION['checker'] = $iid;
    KompletanAuto::writeToUserAddedCar($iid,$_SESSION['id'],$cena);
    KompletanAuto::writeToWaitlist($iid);
    header('location:oglas?id='.$iid.'.php');
    exit();
    }


if(isset($_POST['prikazSvihKorisnika'])){

  $oglasi = Customer::getAllUsers();

  if ($oglasi->num_rows > 0) {
    echo "<table class='table table-striped table-dark'> <thead>
    <tr>
    <th scope='col'>#</th>
      <th scope='col'>ID</th>
      <th scope='col'>Puno ime</th>
      <th scope='col'>Lokacija</th>
      <th scope='col'>Broj telefona</th>
      <th scope='col'>Korisničko ime</th>
      <th scope='col'>E-mail</th>
    </tr>
  </thead>
  <tbody>";
    $nr = 1;
    while ($row = mysqli_fetch_array($oglasi, MYSQLI_ASSOC)) {
      
      echo " 
      <tr id=red" . $row['c_id'] . ">
      <th >" . $nr . "</th>
      <th >" . $row['c_id']. "</th>
        <th scope='row'>" . $row['full_name'] . "</th>
        <td>" . $row['location'] . "</td>
        <td>" . $row['broj_tel'] . "</td>
        <td>" . $row['username'] . "</td>
        <td>" . $row['email'] . "</td> 
        <td> 
        
        <input type='button' class='btn btn-danger my-3 brisanjeKorisnika' name='obrisiKorisnika' id='obrisiK" . $row['c_id'] . "' value='Obriši'>
        </td>
      </tr>";

      $nr += 1;
    }
    echo "</table>";
  }

}
if(isset($_POST['prikazSvihOdobrenihOglasa'])){
  $oglasi = KompletanAuto::getAllOfficialAds();

  if ($oglasi->num_rows > 0) {
    echo "<table class='table table-striped table-dark'> <thead>
    <tr>
    <th scope='col'>#</th>
      <th scope='col'>ID</th>
      <th scope='col'>Brend</th>
      <th scope='col'>Model</th>
      <th scope='col'>Godina</th>
      <th scope='col'>Kilometraza</th>
      <th scope='col'>Gorivo</th>
      <th scope='col'>Tip menjača</th>
      <th scope='col'>Boja</th>
      <th scope='col'>Registrovan?</th>
      <th scope='col'>Cena</th>
      <th scope='col'>Broj vrata</th>
      <th scope='col'>Broj sedišta</th>
      <th scope='col'>Karoserija</th>
      <th scope='col'>Komentar</th>
      <th scope='col'>Opcije</th>
    </tr>
  </thead>
  <tbody>";
  $nr = 1;
    while ($row = mysqli_fetch_array($oglasi, MYSQLI_ASSOC)) {
      $arr = KompletanAuto::readFromDB($row['Cars_Instance_i_id'],2);
      echo " 
      
      <tr id=red".$arr[0].">
      <th >" . $nr . "</th>
        <th scope='row'>".$row['Cars_Instance_i_id']."</th>
        <td>".$arr[13]."</td>
        <td>".$arr[14]."</td>
        <td>".$arr[4]."</td>
        <td>".$arr[3]."</td>
        <td>".$arr[2]."</td>
        <td>".$arr[5]."</td>

        <td>".$arr[16]."</td>
        <td>".$arr[11]."</td>
        <td>".$row['price']."</td>
        <td>".$arr[9]."</td>
        <td>".$arr[12]."</td>
        <td>".$arr[17]."</td>
        <td> <input type='button' class='btn btn-danger my-3' onclick=\"alert('".(string) $arr[7]."')\" value='Prikaži komentar'></td>
        <td> 
        <input type='button' class='btn btn-danger my-3 pogledaj' name='pogledajOglas' id='pogledajOglas".$arr[0]."' value='Pogledaj oglas'>
        <input type='button' class='btn btn-danger my-3 brisanje' name='obrisiOglas' id='obrisi".$arr[0]."' value='Obriši oglas'>
        </td>
      </tr>";

      $nr += 1;
    }
    echo "</table>";
  }

}
if (isset($_POST['prikazSvihNeodobrenihOglasa'])) {
  $oglasi = KompletanAuto::getAllOfficialAds(0);
  if ($oglasi->num_rows > 0) {
    echo "<table class='table table-striped table-dark'> <thead>
    <tr>
    <th scope='col'>#</th>
      <th scope='col'>ID</th>
      <th scope='col'>Brend</th>
      <th scope='col'>Model</th>
      <th scope='col'>Godina</th>
      <th scope='col'>Kilometraza</th>
      <th scope='col'>Gorivo</th>
      <th scope='col'>Tip menjača</th>
      <th scope='col'>Boja</th>
      <th scope='col'>Registrovan?</th>
      <th scope='col'>Cena</th>
      <th scope='col'>Broj vrata</th>
      <th scope='col'>Broj sedišta</th>
      <th scope='col'>Karoserija</th>
      <th scope='col'>Komentar</th>
      <th scope='col'>Opcije</th>
    </tr>
  </thead>
  <tbody>";
    while ($row = mysqli_fetch_array($oglasi, MYSQLI_ASSOC)) {
      $nr=1;
      $arr = KompletanAuto::readFromDB($row['Cars_Instance_i_id'], 2);

      echo " 
      
      <tr id=red" . $arr[0] . ">
      <th >" . $nr . "</th>
        <th scope='row'>" . $row['Cars_Instance_i_id'] . "</th>
        <td>" . $arr[13] . "</td>
        <td>" . $arr[14] . "</td>
        <td>" . $arr[4] . "</td>
        <td>" . $arr[3] . "</td>
        <td>" . $arr[2] . "</td>
        <td>" . $arr[5] . "</td>

        <td>" . $arr[16] . "</td>
        <td>" . $arr[11] . "</td>
        <td>" . $row['price'] . "</td>
        <td>" . $arr[9] . "</td>
        <td>" . $arr[12] . "</td>
        <td>" . $arr[17] . "</td>
        <td> <input type='button' class='btn btn-danger my-3' onclick=\"alert('" . (string) $arr[7] . "')\" value='Prikaži komentar'></td>
        <td> 
        <input type='button' class='btn btn-danger my-3 pogledaj' name='pogledaj' id='pogledajOglas" . $arr[0] . "' value='Izgled oglasa'>
        <input type='button' class='btn btn-danger my-3 prihvatanje' name='prihvatiOglas' id='prihvati" . $arr[0] . "' value='Prihvati'>
        <input type='button' class='btn btn-danger my-3 brisanje' name='obrisiOglas' id='obrisi" . $arr[0] . "' value='Obriši'>
        </td>
      </tr>";

      $nr += 1;
    }
    echo "</table>";
  }
}

if (isset($_POST["prihvatiOglas"])) {
  Admin::approveAd($_POST["prihvatiOglas"]);
  echo "Oglas uspešno prihvaćen.";
}

if (isset($_POST["obrisiKorisnika"])) {
  Admin::deleteUser($_POST["obrisiKorisnika"]);
  echo "Korisnik uspešno izbrisan.";
}

if (isset($_POST["prikaziPretrageKorisnika"])) {
  $result = KompletanAuto::getAllSearchHistory();
  if ($result->num_rows > 0) {
    echo "<table class='table table-striped table-dark'> <thead>
    <tr>
    <th scope='col'>#</th>
      <th scope='col'>ID</th>
      <th scope='col'>Brend</th>
      <th scope-'col'>Naziv brenda </th>
      <th scope='col'>Model</th>
      <th scope='col'>Od godine</th>
      <th scope='col'>Do godine</th>
      <th scope='col'>Maksimalna kilometraža</th>
      <th scope='col'>Gorivo</th>
      <th scope='col'>Tip menjača</th>
      <th scope='col'>Boja</th>
      <th scope='col'>Registrovan?</th>
      <th scope='col'>Cena od</th>
      <th scope='col'>Cena do</th>
      <th scope='col'>Vreme pretrage</th>
      <th scope='col'>Sortirano po</th>
      <th scope='col'>U kakvom poretku</th>
    </tr>
  </thead>
  <tbody>";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $nr=1;

      echo " 
      
      <tr id=red" . $row['p_id'] . ">
      <th >" . $nr . "</th>
        <th scope='row'>" . $row['p_id'] . "</th>
        <td class='brend".$row['p_id']."'>" . $row['brend'] . "</td>
        <td> ". KompletanAuto::getBrandNameFromBrandID($row['brend']) . "</td>
        <td class='model".$row['p_id']."'>" . $row['model'] . "</td>
        <td class='odgod".$row['p_id']."'>" . $row['odgod'] . "</td>
        <td class='dogod".$row['p_id']."'>" . $row['dogod'] . "</td>
        <td class='kilometraza".$row['p_id']."'>" . $row['kilometraza'] . "</td>
        <td class='gorivo".$row['p_id']."'>" . $row['gorivo'] . "</td>

        <td class='menjac".$row['p_id']."'>" . $row['menjac'] . "</td>
        <td class='boje".$row['p_id']."'>" . $row['boje'] . "</td>
        <td class='registracija".$row['p_id']."'>" . $row['registracija'] . "</td>
        <td class='cenaod".$row['p_id']."'>" . $row['cenaod'] . "</td>
        <td class='cenado".$row['p_id']."'>" . $row['cenado'] . "</td>
        <td class='vreme".$row['p_id']."'>" . $row['vreme'] ."</td>
        <td class='po_cemu".$row['p_id']."'>" . $row['po_cemu'] ."</td>
        <td class='kako".$row['p_id']."'>" . $row['kako'] ."</td>
        <td> 
        <input type='button' class='btn btn-danger my-3 ponoviPretragu' name='ponovipretragu' id='ponoviPretragu" . $row['p_id'] . "' value='Ponovi pretragu'>
        <input type='button' class='btn btn-danger my-3 brisanjePretrage' name='obrisiPretragu' id='obrisiPretragu" . $row['p_id'] . "' value='Obriši pretragu'>
        </td>
      </tr>";

      $nr += 1;
    }
    echo "</table>";
  }


}

if(isset($_POST['duplirajPretragu'])){
  $id = $_POST['duplirajPretragu'];
  //CREATE TEMPORARY TABLE tmptable_1 SELECT * FROM table WHERE primarykey = 1;
//UPDATE tmptable_1 SET primarykey = NULL;
//INSERT INTO table SELECT * FROM tmptable_1;
//DROP TEMPORARY TABLE IF EXISTS tmptable_1;
$db1 = mysqli_stmt_init(KompletanAuto::connectToDB());

        $arr = KompletanAuto::getSpecificSearch($id);
        $stmt = "INSERT INTO 'pretrage_korisnika' (brend,model,odgod,dogod,kilometraza,gorivo,menjac,boje,registracija,cenaod,cenado,vreme,c_id,po_cemu,kako) SELECT brend,model,odgod,dogod,kilometraza,gorivo,menjac,boje,registracija,cenaod,cenado,vreme,c_id,po_cemu,kako from 'pretrage_korisnika' where p_id= '$id'";
  echo $stmt;
  #mysqli_stmt_bind_param($db1, $id);
        mysqli_stmt_prepare($db1, $stmt);
        mysqli_stmt_execute($db1);

        echo "nestonestonesto";

        mysqli_stmt_close($db1);
        
}


if(isset($_POST['obrisiPretragu'])){

  Customer::deleteSearch($_POST['obrisiPretragu']);
  echo "Uspešno obrisana pretraga.";
}

if(isset($_POST['dodajKorisnika'])){
      $newusername = mysqli_real_escape_string($db, $_POST['username']);
      $newemail= mysqli_real_escape_string($db, $_POST['email']);
      $password = mysqli_real_escape_string($db, $_POST['password']);

      
      $k = new Customer($newusername, $newemail, $password, "","","");
      $hp = password_hash($password,PASSWORD_BCRYPT);
      $k->writeToDB($hp);

}

if(isset($_POST["izloguj"])){
  session_destroy();
  header("location:index.php");
}
?>