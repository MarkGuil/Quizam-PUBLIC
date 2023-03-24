<?php

function uploadFile($file,$email){
    $number = rand(1,10000);
    $path = 'uploads/'.$number.$email;
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $filex = explode('.',$fileName);
    $newFile = strtolower(end($filex));
    $fileDestination = $path.'.'.$newFile;
    move_uploaded_file( $fileTmpName,$fileDestination);
    $_SESSION['img'] = $fileDestination;

    return $fileDestination;
}