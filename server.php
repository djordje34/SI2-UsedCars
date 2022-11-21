<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$errors = array(); 
// Create connection
$db = mysqli_connect('localhost', 'root','', 'mydb');
// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $conn->connect_error);
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



if (isset($_POST['register']))
{
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

echo $username.$email.$password;

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT u_id FROM user WHERE username=? OR email=? LIMIT 1");
  mysqli_stmt_bind_param($db1, "ss", $username, $email);
  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $user);
  mysqli_stmt_fetch($db1);
  if ($user) // if user exists
  {
    array_push($errors, "Korisničko ime ili e-mail već postoji.");
  }
  
  
  if (count($errors) == 0)
  {
    $hashed_password = password_hash($password,PASSWORD_BCRYPT);//encrypt the password before saving in the database
    
      mysqli_stmt_prepare($db1, "INSERT INTO user (username, email, password) VALUES(?,?,?)");
      mysqli_stmt_bind_param($db1, "sss", $username, $email,$hashed_password);
      mysqli_stmt_execute($db1);
    
      $id=get_user_ID($username);
      mysqli_stmt_prepare($db1, "INSERT INTO customer (c_id) VALUES(?)");
      mysqli_stmt_bind_param($db1, "i", $id);
      mysqli_stmt_execute($db1);
    
    mysqli_stmt_close($db1);
  	header('location: login.php');
  }
}

if(isset($_POST["login"])){


    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($username)) {
        array_push($errors, "Korisničko ime je neophodno!");
    }
    if (empty($password)) {
        array_push($errors, "Lozinka je neophodna!");
    }
  
    if (count($errors) == 0)
    {
      $db1=mysqli_stmt_init($db);
      mysqli_stmt_prepare($db1, "SELECT password FROM user WHERE username=?");
      mysqli_stmt_bind_param($db1, "s", $username);
      mysqli_stmt_execute($db1);
      mysqli_stmt_bind_result($db1, $passworddb);
      mysqli_stmt_fetch($db1);
      if (password_verify($password, $passworddb))
      {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin']= true;
        $id=get_user_ID($username);
        $_SESSION['id']=$id;
        mysqli_stmt_prepare($db1, "SELECT email, balance, full_name FROM user u, customer c WHERE c_id=u_id AND u_id=?");
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $email,$balance,$full_name);
        mysqli_stmt_fetch($db1);
        $_SESSION['email']=$email;
        $_SESSION['balance']=$balance;
        $_SESSION['full_name']=$full_name;

        
        
    
        
        mysqli_stmt_close($db1);
        header('location: index.php');
      }
      else
      {
        array_push($errors, "Wrong username/password combination");
      }
    }
  


}

?>