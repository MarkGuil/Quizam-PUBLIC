<?php


function uploadImage($file)
{
    if ($file['size'] > 0) {
        $number = rand(11990,190000);
        $path = 'uploads/' . $number;
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        $filex = explode('.', $fileName);
        $newFile = strtolower(end($filex));
        $fileDestination = $path . '.' . $newFile;
        move_uploaded_file($fileTmpName, $fileDestination);

        return $fileDestination;
    }
    return null;
}
