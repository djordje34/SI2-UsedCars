<?php
require_once 'DataBaseConnector.php';
class Korisnik
{
    protected $username;
    protected $email;
    protected $password;

    protected $dbConn;
    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;

    }

    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }

    #STATICS
    public static function connectToDB()
    {
        return DataBaseConnector::getConnect();

    }

    public static function checkIfPossible($uname, $email)
    {
        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT u_id FROM user WHERE username = ? OR email = ?");
        mysqli_stmt_bind_param($db1, "ss", $uname, $email);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $user);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);

        if (!$user) {
            return false;
        }
        return true;
    }


    public static function readFromDB($id)
    {
        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT username,email,password FROM user WHERE u_id = ?");
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $username, $email, $password);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        return new Korisnik($username, $email, $password);
    }
    
    public static function getPWFromUN($uname){

        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT password FROM user WHERE username = ?");
        mysqli_stmt_bind_param($db1, "s", $uname);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$pw);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);

        return $pw;
    }

    public static function staticGetID($username)
    {
        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT u_id FROM user WHERE username = ?");
        mysqli_stmt_bind_param($db1, "s", $username);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $id);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        return $id;
    }


    #OBJECT
    public function writeToDB($newPW)
    {
        $db1 = mysqli_stmt_init($this->connectToDB());
        mysqli_stmt_prepare($db1, "INSERT INTO user (username, email, password) VALUES(?,?,?)");
        mysqli_stmt_bind_param($db1, "sss", $this->username, $this->email, $newPW);
        mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);
    }


    public function StringifyEcho()
    {
        echo $this->username . " " . $this->email . " " . $this->password . " ";
    }

    public function getID()
    {
        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT u_id FROM user WHERE username = ?");
        mysqli_stmt_bind_param($db1, "s", $this->username);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $id);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        return $id;
    }
    public function editTrait($koji, $kako)
    {
        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        $id = $this->getID();
        if ($koji == "username") {
            mysqli_stmt_prepare($db1, "UPDATE user SET username=? WHERE u_id=?");
            mysqli_stmt_bind_param($db1, "si", $kako, $id);
            mysqli_stmt_execute($db1);
            mysqli_stmt_close($db1);
            $this->username = $kako;
        } else if ($koji == "email") {
            mysqli_stmt_prepare($db1, "UPDATE user SET email=? WHERE u_id=?");
            mysqli_stmt_bind_param($db1, "si", $kako, $id);
            mysqli_stmt_execute($db1);
            mysqli_stmt_close($db1);
            $this->email = $kako;
        }

    }

}

?>