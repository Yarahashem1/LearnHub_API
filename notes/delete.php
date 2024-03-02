<?php 
  include "../connect.php";
  include "../files/test.php";

  $notes_id = htmlspecialchars(strip_tags($_POST['notes_id']));
  $imagename = htmlspecialchars(strip_tags($_POST['imagename']));
  $stmt = $con->prepare("
  DELETE FROM `notes` WHERE notes_id = ?
  ");
  $stmt->execute(array($notes_id));
  $count = $stmt->rowCount();
  if($count > 0) {
   // delete_file("../images",$imagename);
    echo json_encode(array("status" => "success"));
  } else {
    echo json_encode(array("status" => "fail"));
  }


?>