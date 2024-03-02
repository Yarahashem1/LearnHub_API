<?php 
  include "../connect.php";

  $notes_users = htmlspecialchars(strip_tags($_POST['notes_users']));
  $stmt = $con->prepare("
  SELECT * FROM `notes` WHERE notes_users = ?
  ");
  $stmt->execute(array($notes_users));
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count = $stmt->rowCount();
  if($count > 0) {
    echo json_encode(array("status" => "success","data" => $data));
  } else {
    echo json_encode(array("status" => "fail"));
  }


?>