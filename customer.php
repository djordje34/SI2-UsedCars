<?php
require_once 'korisnik.php';
class Customer extends Korisnik{
    private $id;
    private $fullname;
    private $location;

    private $tel;

    public function __construct($username, $email, $password,$fullname,$location,$tel) {

        parent::__construct($username, $email, $password);
        $this->fullname = $fullname;
        $this->location = $location;
        $this->tel = $tel;
      }


    public function getFullName()
    {
        return $this->fullname;
    }
    public function getLocation()
    {
        return $this->location;
    }
    public function getPhoneNumber()
    {
        return $this->tel;
    }
    #STATICS
    public static function readFromDB($id)
    {

        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT username,email,password,full_name,location,broj_tel FROM
         user INNER JOIN customer ON u_id = c_id AND u_id = ?");
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $username, $email, $password,$fullname,$location,$mob);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        return new Customer($username, $email, $password,$fullname,$location,$mob);

    }
    #OBJECT

    public static function generateFromID($id){
        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT username,email,password,full_name,location,broj_tel
         FROM user u, customer c WHERE c_id=u_id AND u_id=?");
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $username, $email, $password,$fullname,$location,$mob);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        return new Customer($username, $email, $password, $fullname, $location, $mob);

    }


                            //loggedUserID->ukoliko se radi o proveri u okviru registracije ->-1,ako profil->X
    public static function checkIfUsernameAvailable($uname,$loggedUserID=-1){
        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        if ($loggedUserID != -1) {  //user ID->korisnik menja username, znaci traziti da li postoji negde drugde osim kod njega
            mysqli_stmt_prepare($db1, "SELECT u_id FROM user WHERE username=? AND u_id!=?");
            mysqli_stmt_bind_param($db1, "si", $uname,$loggedUserID);
        }
        else{   //nema user ID->radi se o reg
            mysqli_stmt_prepare($db1, "SELECT u_id FROM user WHERE username=?");
            mysqli_stmt_bind_param($db1, "s", $uname);
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


    public static function updateFields($username,$email,$fullname,$location,$tel,$id){
        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        mysqli_stmt_prepare($db1, "UPDATE customer SET full_name=?,location=?,broj_tel=? WHERE c_id=?");
        mysqli_stmt_bind_param($db1, "sssi", $fullname,$location,$tel,$id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);

        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        mysqli_stmt_prepare($db1, "UPDATE user SET username=?,email=? WHERE u_id=?");
        mysqli_stmt_bind_param($db1, "ssi", $username,$email,$id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);
    }


    public function StringifyEcho()
    {
        echo $this->username . " " . $this->email . " " . $this->password . " ".$this->fullname." ".
        $this->location." ".$this->tel." ";
    }
    public function writeToDB($newPW)
    {
        parent::writeToDB($newPW);
        $id = parent::getID();
        $db1 = mysqli_stmt_init($this->connectToDB());
        mysqli_stmt_prepare($db1, "INSERT INTO customer (c_id) VALUES(?)");
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);
        $this->id = $id;        
    }

public static function getAllUsers(){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT c_id,full_name,location,broj_tel,username,email FROM customer c, user u WHERE u.u_id=c.c_id");
        mysqli_stmt_execute($db1);
        $result = mysqli_stmt_get_result($db1);
        mysqli_stmt_close($db1);
        return $result;
}
public static function deleteSearch($sid){
    $db1 = mysqli_stmt_init(self::connectToDB());
    mysqli_stmt_prepare($db1, "DELETE FROM pretrage_korisnika WHERE p_id = ?");
        mysqli_stmt_bind_param($db1, "i", $sid);
        mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);
}

}

//Customer::readFromDB('1')->StringifyEcho();
?>