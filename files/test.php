<?php

function uploadImage($fileRequest) {
   $imageName = $_FILES[$fileRequest]['name'];
   $imageTmp = $_FILES[$fileRequest]['tmp_name'];
   $imageSize = $_FILES[$fileRequest]['size'];
   $allowExt = array("jpg","png","gif");
   $stringToArray = explode(".",$imageName);
   $ext = end($stringToArray);
   $ext = strtolower($ext);
   if(in_array($ext,$allowExt) && $imageSize < 2*1048576) {
        move_uploaded_file($imageTmp,"../auth/images/" . $imageName);
        return $imageName;
   } else {
      return "fail";
   }
}

function delete_file($dir,$filename) {
   if(file_exists($dir . "/" . $filename)) {
      unlink($dir . "/" . $filename);
   }
}


?>