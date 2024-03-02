<?php 
  include "../connect.php";
  include "../files/test.php";

  $cource_id = htmlspecialchars(strip_tags($_POST['id']));
  $imagename = htmlspecialchars(strip_tags($_POST['imagename']));
  $stmt = $con->prepare("
  DELETE FROM `mycources` WHERE id = ?
  ");
  $stmt->execute(array($cource_id));
  $count = $stmt->rowCount();
  if($count > 0) {
   // delete_file("../images",$imagename);
    echo json_encode(array("status" => "success"));
  } else {
    echo json_encode(array("status" => "fail"));
  }


?>