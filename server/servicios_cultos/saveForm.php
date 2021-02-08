<?php
    // FUNCIONES DEL SISTEMA
    include_once '../class/config.php';
    require_once '../class/control.class.php';

    // INICIALIZAMOS LA CLASE
    $TDV = new control($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
   
    if(isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["fileUpload"]["name"];
        $filetype = $_FILES["fileUpload"]["type"];
        $filesize = $_FILES["fileUpload"]["size"];
    
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        if(in_array($filetype, $allowed)){
            $filename = $_POST["txt_idServicio"].".png";

            if(file_exists($_SERVER["DOCUMENT_ROOT"]."/images/servicios/" . $filename)){
                // echo $filename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/images/servicios/" . $filename);
                // echo "Your file was uploaded successfully.";
            } 
        } else{
            // echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        // echo "Error: " . $_FILES["fileUpload"]["error"];
    }

    $TDV->saveCultos($_POST, $_POST["txt_idServicio"]);