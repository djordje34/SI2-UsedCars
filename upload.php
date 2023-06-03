<?php
include('server.php');
$_SESSION['uploadstatus']='';
// Slika
if(isset($_POST["submitImg"]))
{
    $username=$_SESSION['username'];
    $target_dir = "slike/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
        $uploadOk = 1;
    }
    else
    {
        $_SESSION['uploadstatus'] = "File is not an image.";
        $uploadOk = 0;
    }
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000)
{
    $_SESSION['uploadstatus'] = "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
{
    $_SESSION['uploadstatus'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0)
{
    $_SESSION['uploadstatus'] . "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else
{
    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
    $dbname=$_SESSION['id'].time() .'.' .end($temp);
    $newfilename =$target_dir . $dbname;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] ,$newfilename))
    {
        $_SESSION['uploadstatus'] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            $id = $_GET['id'];
            $db1=mysqli_stmt_init($db);
        mysqli_stmt_prepare($db1, "INSERT INTO ci_has_image (ci_id,img) VALUES(?,?)");
        
        mysqli_stmt_bind_param($db1, "is",$id, $dbname);#!!!
        mysqli_stmt_execute($db1);
       

        #mysqli_stmt_prepare($db1, "UPDATE motocikl SET slika=? WHERE m_id=?");
        #    $mid = 1;
        #mysqli_stmt_bind_param($db1, "si",$dbname,$mid);#!!!
        #mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);



        header('location:oglas.php?id='.$id);
    }
    else
    {
        $_SESSION['uploadstatus'] = "Sorry, there was an error uploading your file.";
    }
}
}

?>