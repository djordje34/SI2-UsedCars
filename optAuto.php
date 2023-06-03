<?php
require_once 'auto.php';
class KompletanAuto extends Auto{
    private $fuel;
    private $mileage;
    private $year;
    private $transmission;
    private $boja_id;
    private $komentar;
    private $motor;
    private $num_doors;
    private $body_id;
    private $registracija;

    private $num_sed;
    public function __construct($brand_id,$model,$fuel,$mileage,
                            $year,$transmission,$boja_id,$komentar,
                                    $motor,$num_doors,$body_id,$registracija,$num_sed)
    {
        parent::__construct($brand_id, $model);
        
        $this->fuel=$fuel;
        $this->mileage=$mileage;
        $this->year=$year;
        $this->transmission=$transmission;
        $this->boja_id=$boja_id;
        $this->komentar=$komentar;
        $this->motor=$motor;
        $this->num_doors=$num_doors;
        $this->body_id=$body_id;
        $this->registracija = $registracija;
        $this->num_sed = $num_sed;
    }
    public static function getSpecificSearch($id){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT brend,model,odgod,dogod,kilometraza,gorivo,menjac,boje,registracija,cenaod,cenado,vreme,c_id,po_cemu,kako from pretrage_korisnika where p_id = ?"); 
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$brend,$model,$odgod,$dogod,$kilometraza,$gorivo,$menjac,$boje,$registracija,$cenaod,$cenado,$vreme,$c_id,$po_cemu,$kako);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        return array($brend,$model,$odgod,$dogod,$kilometraza,$gorivo,$menjac,$boje,$registracija,$cenaod,$cenado,$vreme,$c_id,$po_cemu,$kako);
    }
    public static function getAllSearchHistory(){
        $id = $_SESSION['id'];
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT p_id,c_id,brend,model,odgod,dogod,kilometraza,gorivo,menjac,boje,registracija,cenaod,cenado,vreme,po_cemu,kako from pretrage_korisnika where c_id = ? ORDER BY p_id DESC"); 
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        $result = mysqli_stmt_get_result($db1);
        mysqli_stmt_close($db1);
        return $result;
    }
    public static function getSearchHistory(){
        $id = $_SESSION['id'];
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT brend,model,odgod,dogod,kilometraza,gorivo,menjac,boje,registracija,cenaod,cenado,vreme,po_cemu,kako from pretrage_korisnika where vreme in(SELECT MAX(vreme) as mv from pretrage_korisnika where c_id = ? GROUP BY c_id)"); 
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$brend,$model,$odgod,$dogod,$kilometraza,$gorivo,$menjac,$boje,$registracija,$cenaod,$cenado,$vreme,$po_cemu,$kako);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        return array($brend,$model,$odgod,$dogod,$kilometraza,$gorivo,$menjac,$boje,$registracija,$cenaod,$cenado,$vreme,$po_cemu,$kako);

    }
    public static function getMotore($params)
    {

        $db1 = mysqli_stmt_init(self::connectToDB());
        if (empty($params)) {
            mysqli_stmt_prepare($db1, "SELECT m_id,marka,model,tip");
            mysqli_stmt_execute($db1);
            $result = mysqli_stmt_get_result($db1);
            mysqli_stmt_close($db1);
        } else {
            foreach ($params as $key => $val) {
                $params[$key] = "%" . strtolower($val) . "%";
            }
            $stmt = "SELECT m_id,marka,model,tip,slika FROM motocikl WHERE marka LIKE ? AND model LIKE ? AND tip LIKE ? ";
            mysqli_stmt_prepare($db1, $stmt);
            mysqli_stmt_bind_param($db1, "sss", $params[0], $params[1], $params[2]);
            mysqli_stmt_execute($db1);
            $result = mysqli_stmt_get_result($db1);



        }
        return $result;
    }
    public static function izlistajMotore($params){
        $returnable = "";
        $result = KompletanAuto::getMotore($params);

        $returnable.= "<div class='container mt-5 mb-5'>
        <div class='d-flex justify-content-center row'>
            <div class='col-md-10'>";
           if ($result->num_rows > 0) {
               #mysqli_stmt_fetch($db1);
               while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {



                $returnable .= "<p name='brojredova' hidden>0</p> <div class='row p-2 bg-white border rounded'>
                   
                   <div class='col-md-6 mt-1'>
                   <img src='slike/".$row['slika']."' alt='slika'/>
                       <h5>" . $row['marka'] . " " . $row['model'] . "(" . $row['tip'] . ")" . "</h5>
                       <div class='d-flex flex-row'>
                           
                    
                   </div>
                   </div>";
                  
              
   
               }
               
           }

           $returnable.= "
           </div>
       </div>
   </div>";
           return $returnable;


    }
    public static function izlistajSaParametrima($params,$page){
        $returnable = '';
        $nmb = 0;
     $db1 = mysqli_stmt_init(KompletanAuto::connectToDB());
     $resultArr = KompletanAuto::getAllAds($params,$page);
    $result = $resultArr[0];
    $numr = $resultArr[1];
     $returnable.= "<div class='container mt-5 mb-5'>
     <div class='d-flex justify-content-center row'>
         <div class='col-md-10'>";
        if ($result->num_rows > 0) {
            #mysqli_stmt_fetch($db1);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                $auto = KompletanAuto::readFromDB($row['Cars_instance_i_id'],2);
                $slika = KompletanAuto::GetFirstImg($row['Cars_instance_i_id']);
                if (!$slika)
                    $slika = 'logo.png';
                    $returnable.= "<p name='brojredova' hidden>".$numr."</p> <div class='row p-2 bg-white border rounded'>
                <div class='col-md-3 mt-1'><img class='img-fluid img-responsive rounded product-image' src='slike/".$slika."' style='width:200px;height:200px;'></div>
                <div class='col-md-6 mt-1'>
                    <h5>".$auto[13]." ".$auto[14]."(".$auto[4].")"."</h5>
                    <div class='d-flex flex-row'>
                        
                    </div>
                    <div class='mt-1 mb-1 spec-1'> <span>Kubikaža motora: ".$auto[8]."</span>
                    <span>Gorivo: ".$auto[2]."</span>
                    <span>Kilometraža: ".$auto[3]." km</span>
                    <span>Menjač: ".$auto[5]."</span>
                    <span>Broj vrata: ".$auto[9]."</span>
                    <span>Karoserija: ".$auto[17]."</span>
                </div>
                </div>
                <div class='align-items-center align-content-center col-md-3 border-left mt-1'>
                    <div class='d-flex flex-row align-items-center'>
                        <h4 class='mr-1'>".$row['price']."€</h4>
                    </div>
                    <div class='d-flex flex-column mt-4'>
                    <input class='btn btn-danger btn-sm prikazikontakt' id='".$row['Cars_instance_i_id']."' name='contact' type='submit'  value='Prikaži kontakt'>
                    </div>
                    <div style='font-size:12;' id ='show_contact".$row['Cars_instance_i_id']."'></div>
                    <div class='d-flex flex-column mt-4'>
                    <a role='button' name='prikaziViseOOglasu' class='btn btn-danger btn-sm prikaziviseoglas' id='prikazVise".$row['Cars_instance_i_id']."' href=\"oglasinfo.php?id=".$row['Cars_instance_i_id']."\" target='_blank'>
                    
                    Prikaži više o oglasu
                    </a>
                    </div>
                </div>
                
            </div>
            
            
            ";

            }
            echo "<script>
            document.getElementsByName('odkoliko')[0].textContent='".(ceil($numr/20)-1)."'; </script>";
        }
        else{
            $returnable = "<div><div><div><h2>Ne postoji oglas sa tim parametrima. </h2>";
        }
        $returnable.= "
        </div>
    </div>
</div>
        
        ";
        return $returnable;
    }

    public static function getSellerFromCarID($id){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT Customer_c_id from customer_is_selling where Cars_Instance_i_id = ?"); 
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$cid);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        return $cid;

    }
    public static function getCarTitleFromID($id){
        $arr = KompletanAuto::readFromDB($id, 2);

        return array($arr[13], $arr[14], $arr[4]);
    }
    public static function getBrandNameFromBrandID($id){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT name from brands where brand_id = ?"); 
        mysqli_stmt_bind_param($db1, "i", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$name);
        mysqli_stmt_fetch($db1);
        mysqli_stmt_close($db1);
        return $name;
    }
    public static function getImagesFromID($id){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT img_id,ci_id,img FROM ci_has_image WHERE ci_id=?");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);
        $result = mysqli_stmt_get_result($db1);
        mysqli_stmt_close($db1);
        return $result;
    }
    public static function readFromDB($id, $type=1)
    {
        $db1 = mysqli_stmt_init(self::connectToDB());
        if ($type==1){
            mysqli_stmt_prepare($db1, "SELECT brand_id,model,fuel,mileage,year,transmission,
            boja_id,komentar,motor,num_doors,body_id,registracija FROM cars c,cars_instance ci
            WHERE c.cars_id = ci.cars_id AND ci.i_id = ?"); 
            mysqli_stmt_bind_param($db1, "i", $id);
            mysqli_stmt_execute($db1);
            mysqli_stmt_bind_result($db1,$brand_id,$model,$fuel,$mileage,
                                    $year,$transmission,$boja_id,$komentar,
                                    $motor,$num_doors,$body_id,$registracija,$num_sed);
            mysqli_stmt_fetch($db1);
            mysqli_stmt_close($db1);
            return new KompletanAuto($brand_id,$model,$fuel,$mileage,
                            $year,$transmission,$boja_id,$komentar,
                            $motor,$num_doors,$body_id,$registracija,$num_sed);
        }
        else if($type==2){
            mysqli_stmt_prepare($db1, "SELECT 
            ci.i_id,	
            ci.cars_id,	
            ci.fuel,	
            ci.mileage,	
            ci.year,	
            ci.transmission,	
            ci.boja_id,	
            ci.komentar,	
            ci.motor,	
            ci.num_doors,	
            ci.body_id,	
            ci.registracija,	
            ci.num_sed,	
            br.name,	
            c.model,	
            c.brand_id,	
            b.name,
            bd.type
            FROM cars_instance ci, brands br, cars c, boja b,body bd WHERE ci.cars_id = c.cars_id AND br.brand_id = c.brand_id AND b.boja_id = ci.boja_id AND bd.body_id = ci.body_id AND ci.i_id = ?"); 
            mysqli_stmt_bind_param($db1, "i", $id);
            mysqli_stmt_execute($db1);
            mysqli_stmt_bind_result($db1,$i_id,$cars_id,$fuel,$mileage,
                                    $year,$transmission,$boja_id,$komentar,
                                    $motor,$num_doors,$body_id,$registracija,$num_sed,$brand_name,$model,$brand_id,$ime_boje,$type);
            mysqli_stmt_fetch($db1);
            mysqli_stmt_close($db1);

            return array(
                $i_id,
                $cars_id,
                $fuel,
                $mileage,
                $year,
                $transmission,
                $boja_id,
                $komentar,
                $motor,
                $num_doors,
                $body_id,
                $registracija,
                $num_sed,
                $brand_name,
                $model,
                $brand_id,
                $ime_boje,
                $type
            );

        }
        
    }
    public static function getItemOfSeller($id,$item){

        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT ".$item." FROM customer_is_selling cs INNER JOIN customer c ON cs.Customer_c_id=c.c_id WHERE Cars_Instance_i_id=?;");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$location);
        mysqli_stmt_fetch($db1);
       
        mysqli_stmt_close($db1);
        return $location;
    }

    public static function getAllOfficialAds($approved=1){
        $db1 = mysqli_stmt_init(self::connectToDB());
        if ($approved==1){
            $chng = "NOT";
        }
        else
            $chng = "";
        $stmt = "SELECT Cars_Instance_i_id,price FROM customer_is_selling WHERE Cars_Instance_i_id ".$chng." IN(SELECT i_id from ci_to_approve)";
        mysqli_stmt_prepare($db1, $stmt);
        mysqli_stmt_execute($db1);
        $result = mysqli_stmt_get_result($db1);
        mysqli_stmt_close($db1);
        return $result;
    }

    public static function getAllAds($params=[],$page=0){
        $db1 = mysqli_stmt_init(self::connectToDB());
        if (empty($params)) {
            mysqli_stmt_prepare($db1, "SELECT Cars_Instance_i_id,price FROM customer_is_selling");
            mysqli_stmt_execute($db1);
            $result = mysqli_stmt_get_result($db1);
            mysqli_stmt_close($db1);
        }
        else{
            $stmt = "SELECT cis.Cars_instance_i_id,cis.price,cin.mileage,cin.year FROM customer_is_selling cis, cars_instance cin WHERE cis.Cars_Instance_i_id = cin.i_id AND Cars_instance_i_id in (SELECT  ci.i_id	
            FROM cars_instance ci, brands br, cars c, boja b,body bd,customer_is_selling cs WHERE ci.cars_id = c.cars_id AND br.brand_id = c.brand_id AND b.boja_id = ci.boja_id AND bd.body_id = ci.body_id AND ci.i_id = cs.Cars_Instance_i_id
             AND (LOWER(c.model) LIKE ?) AND (ci.year>?) AND (ci.year<?) AND (CONVERT(ci.mileage,SIGNED) < ?) AND (LOWER(ci.fuel) LIKE ?) 
                    AND (LOWER(ci.transmission) LIKE ?) AND (LOWER(b.name) LIKE ?) AND ((ci.registracija) LIKE ? ) AND (CONVERT(cs.price,SIGNED) >= ? AND CONVERT(cs.price,SIGNED) <= ?)";


            
                if($params[9]==''){
                    $params[9] = '0';
                }
                if($params[10]==''){
                    $params[10] = '99999';
                            }
                if ($params[10]<$params[9]){
                    $params[10]='99999';
                }
                if ($params[3]<$params[2]){
                    $params[3]='9999';
                }
    
                foreach($params as $key=>$val){
                    if(in_array($key,[1,5,6,7,8]))
                        $params[$key] = "%" . strtolower($val) . "%";
                }
                
                if($params[0]!='Svejedno'){
                    $temp = $stmt . ' AND (LOWER(br.brand_id) = ?)) AND Cars_instance_i_id  NOT IN (SELECT i_id from ci_to_approve)';
                    $stmt.=' AND (LOWER(br.brand_id) = ?)) AND Cars_instance_i_id  NOT IN (SELECT i_id from ci_to_approve) '.$params[11].$params[12].' LIMIT '.($page*20).','.(20);
                    
                    mysqli_stmt_prepare($db1, $stmt); 
                    mysqli_stmt_bind_param($db1, "sssssssssss", $params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9],$params[10],$params[0]);
                    $howm = "sssssssssss";
                }
                else{
                    $temp = $stmt . ') AND Cars_instance_i_id  NOT IN (SELECT i_id from ci_to_approve)';
                    $stmt .= ')AND Cars_instance_i_id  NOT IN (SELECT i_id from ci_to_approve) '.$params[11].$params[12].' LIMIT '.($page*20).','.(20);
                    mysqli_stmt_prepare($db1, $stmt); 
                    mysqli_stmt_bind_param($db1, "ssssssssss", $params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9],$params[10]);
                    $howm = "ssssssssss";
                }
                mysqli_stmt_execute($db1);
                $result = mysqli_stmt_get_result($db1);


                mysqli_stmt_prepare($db1, $temp);
            if ($howm == "ssssssssss") {
                mysqli_stmt_bind_param($db1, "ssssssssss", $params[1], $params[2], $params[3], $params[4], $params[5], $params[6], $params[7], $params[8], $params[9], $params[10]);
            }
            else{
                mysqli_stmt_bind_param($db1, "sssssssssss", $params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9],$params[10],$params[0]);
            }
                mysqli_stmt_execute($db1);
                $tempres = mysqli_stmt_get_result($db1);
                $numr = $tempres->num_rows;
                mysqli_stmt_close($db1);
            return array($result,$numr);
        }
        return $result;
    }
    public static function getAdsFromUserId($id){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT Cars_instance_i_id,price FROM customer_is_selling WHERE Customer_c_id=? ");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);
        $result = mysqli_stmt_get_result($db1);
        mysqli_stmt_close($db1);
        return $result;

    }
    public static function deleteCarImage($imgid){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "DELETE FROM ci_has_image WHERE img_id = ?");
        mysqli_stmt_bind_param($db1, "i",$imgid);
        mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);
    }
    public static function izbrisiAutoiAd($id){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "DELETE FROM cars_instance WHERE i_id = ?");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);

        mysqli_stmt_prepare($db1, "DELETE FROM ci_has_image WHERE ci_id = ?");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);


        mysqli_stmt_prepare($db1, "DELETE FROM ci_to_approve WHERE i_id = ?");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);

        mysqli_stmt_close($db1);



    }
    public static function setCenaFromID($id,$price){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "UPDATE customer_is_selling SET price = ? WHERE Cars_Instance_i_id = ?");
        mysqli_stmt_bind_param($db1, "si",$price,$id);
        mysqli_stmt_execute($db1);

        mysqli_stmt_close($db1);
    }
    public static function getCenaFromID($id){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT price FROM customer_is_selling WHERE  Cars_Instance_i_id=? LIMIT 1");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$cena);
        mysqli_stmt_fetch($db1);
       
        mysqli_stmt_close($db1);
        return $cena;
    }
    public static function getFirstImg($id){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT img FROM ci_has_image WHERE  ci_id=? LIMIT 1");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$img);
        mysqli_stmt_fetch($db1);
       
        mysqli_stmt_close($db1);
        return $img;
    }
    public static function writeToWaitlist($id){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "INSERT INTO ci_to_approve (i_id) VALUES(?)");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);

        mysqli_stmt_close($db1);

    }
    public static function checkIfInWaitlist($id){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT i_id FROM ci_to_approve WHERE i_id=?");
        mysqli_stmt_bind_param($db1, "i",$id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$i_id);
        mysqli_stmt_fetch($db1);
       
        mysqli_stmt_close($db1);
        return $i_id;
    }

    public static function writeToUserAddedCar($cid,$uid,$price){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "INSERT INTO customer_is_selling (Cars_Instance_i_id,Customer_c_id,price	
        ) VALUES(?,?,?)");
        mysqli_stmt_bind_param($db1, "iis",$cid,$uid,$price);
        mysqli_stmt_execute($db1);

        mysqli_stmt_close($db1);

    }
    public function writeToDB(){//br sedista
        parent::writeToDB();
        $c_id = parent::checkIfCombinationExists($this->brand_id, $this->model);

        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "INSERT INTO cars_instance (cars_id,fuel,mileage,year,transmission,
        boja_id,komentar,motor,num_doors,body_id,registracija,num_sed) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($db1, "issssisssiss",$c_id, $this->fuel,$this->mileage,
        $this->year,$this->transmission,$this->boja_id,$this->komentar,
        $this->motor,$this->num_doors,$this->body_id,$this->registracija,$this->num_sed);
        mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);


        #WRITE TO USER ADDED CAR!!!
    }

    public function getThisID(){
        $db1 = mysqli_stmt_init(self::connectToDB());
        mysqli_stmt_prepare($db1, "SELECT i_id FROM cars_instance WHERE cars_id=? AND fuel=? AND mileage=? AND
        year=? AND transmission=? AND boja_id=? AND komentar =? AND motor =? AND num_doors =? AND
        body_id=? AND registracija=? AND num_sed=? ORDER BY i_id DESC");
        $c_id = parent::checkIfCombinationExists($this->brand_id, $this->model);
        mysqli_stmt_bind_param($db1, "issssisssiss",$c_id, $this->fuel,$this->mileage,
        $this->year,$this->transmission,$this->boja_id,$this->komentar,
        $this->motor,$this->num_doors,$this->body_id,$this->registracija,$this->num_sed);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1,$i_id);
        mysqli_stmt_fetch($db1);

        mysqli_stmt_close($db1);

        return $i_id;
    }



}
?>