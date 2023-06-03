<?php
require_once 'DataBaseConnector.php';
class Auto{

    protected $model;
    protected $brand_id;

    public function __construct($brand_id,$model){
        $this->brand_id = $brand_id;
        $this->model = $model;
    }

    public function getBrandID(){
        return $this->brand_id;
    }
    public function getModel(){
        return $this->model;
    }


    public static function readFromDB($id){
        $db1 = mysqli_stmt_init(Korisnik::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT brand_id,model FROM cars WHERE cars_id = ?");
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $brand_id, $model);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        return new Auto($brand_id, $model);
    }

    public static function connectToDB()
    {
        return DataBaseConnector::getConnect();

    }


    public function writeToDB(){#osluskuje input i vraca da li brand i model postoje
        $db1 = mysqli_stmt_init(self::connectToDB());
        if(!self::checkIfCombinationExists($this->brand_id,$this->model)){
            mysqli_stmt_prepare($db1, "INSERT INTO cars (brand_id, model) VALUES(?,?)");
            mysqli_stmt_bind_param($db1, "is", $this->brand_id, $this->model);
            mysqli_stmt_execute($db1);
            mysqli_stmt_close($db1);
        }
        
    }


    public static function checkIfCombinationExists($brand_id,$model){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT cars_id FROM cars WHERE brand_id=? AND model=? LIMIT 1");
        mysqli_stmt_bind_param($db1, "is", $brand_id,$model);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $isIt);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        if(!$isIt){
            return false;
        }
        return $isIt;
    }
}



?>