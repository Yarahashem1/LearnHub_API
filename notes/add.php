<?php 
  include "../connect.php";
  include "../files/test.php";

  $title = htmlspecialchars(strip_tags($_POST['notes_title']));
  $content = htmlspecialchars(strip_tags($_POST['notes_content']));
  $image = uploadImage("file");
  $notes_users = htmlspecialchars(strip_tags($_POST['notes_users']));
  $stmt = $con->prepare("
  INSERT INTO `notes`(`notes_title`, `notes_content`,`notes_image`, `notes_users`) VALUES (?,?,?,?)
  ");
  $stmt->execute(array($title,$content,$image,$notes_users));
  $count = $stmt->rowCount();
  if($count > 0) {
    echo json_encode(array("status" => "success"));
  } else {
    echo json_encode(array("status" => "fail"));
  }


?>