


<?php
require_once 'korisnik.php';

class Admin extends Korisnik{#static funkcije, jedan admin
    private static $isThere;
    public function __construct($username, $email, $password) {

        parent::__construct($username, $email, $password);

      }


    public static function approveAd($cid){
      $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "DELETE FROM ci_to_approve WHERE i_id = ?");
        mysqli_stmt_bind_param($db1, "i",$cid);
        mysqli_stmt_execute($db1);

        mysqli_stmt_close($db1);
    }
    public static function deleteAd($cid){ #radi skalabilnosti apliakcije, i cuvanja podataka izbrisati samo customer_is_selling
      $db1 = mysqli_stmt_init(self::connectToDB());
      mysqli_stmt_prepare($db1, "DELETE FROM ci_to_approve WHERE i_id = ?");#cid->car instance id
        mysqli_stmt_bind_param($db1, "i",$cid);
        mysqli_stmt_execute($db1);

        mysqli_stmt_prepare($db1, "DELETE FROM customer_is_selling WHERE Car_Instance_i_id = ?");#cid->car instance id
        mysqli_stmt_bind_param($db1, "i",$cid);
        mysqli_stmt_execute($db1);

        mysqli_stmt_close($db1);
    }

    public static function deleteUser($uid){  #customer se automatski brise!
      $db1 = mysqli_stmt_init(self::connectToDB());
      mysqli_stmt_prepare($db1, "DELETE FROM user WHERE u_id = ?");#cid->car instance id
        mysqli_stmt_bind_param($db1, "i",$uid);
        mysqli_stmt_execute($db1);

        mysqli_stmt_close($db1);
    }
    public static function addAdmina(){
      if(!self::$isThere){
        $pw = 'admin';
        $hpw = password_hash($pw,PASSWORD_BCRYPT);
        $admin = new Korisnik('admin','admintim@udomiauto.com',$hpw);
        $admin->writeToDB($hpw);
        $id = $admin->getID();
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "INSERT INTO admin (a_id) VALUES(?)");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);
        self::$isThere = 1;
      }
    }
    public static function loadPassword(){
      $db1 = mysqli_stmt_init(self::connectToDB());
      mysqli_stmt_prepare($db1, "SELECT u_id,username,email,password FROM
         user INNER JOIN admin ON u_id = a_id");#samo jedan admin
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$id, $username, $email, $password);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);

    return $password;

    }
    public static function loadID(){
      $db1 = mysqli_stmt_init(self::connectToDB());
      mysqli_stmt_prepare($db1, "SELECT u_id,username,email,password FROM
         user INNER JOIN admin ON u_id = a_id");#samo jedan admin
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$id, $username, $email, $password);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);

    return $id;

    }

}
