<?php 
  include "../connect.php";

  $title = htmlspecialchars(strip_tags($_POST['notes_title']));
  $content = htmlspecialchars(strip_tags($_POST['notes_content']));
  $notes_users = htmlspecialchars(strip_tags($_POST['notes_users']));
  $stmt = $con->prepare("
  UPDATE `notes` SET `notes_title`=?,`notes_content`=? WHERE notes_users = ?
  ");
  $stmt->execute(array($title,$content,$notes_users));
  $count = $stmt->rowCount();
  if($count > 0) {
    echo json_encode(array("status" => "success"));
  } else {
    echo json_encode(array("status" => "fail"));
  }


?>