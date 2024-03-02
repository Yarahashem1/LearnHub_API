<?php 
  include "../connect.php";
  include "../files/test.php";

  $name = htmlspecialchars(strip_tags($_POST['name']));
  $email = htmlspecialchars(strip_tags($_POST['email']));
  $password = htmlspecialchars(strip_tags($_POST['password']));
  $phone = htmlspecialchars(strip_tags($_POST['phone']));
  $id = htmlspecialchars(strip_tags($_POST['id']));
  $image = htmlspecialchars(strip_tags($_POST['image']));

  //new upload
  if(isset ($_FILES['image'])){
    delete_file("images/",$image);
    $image = uploadImage("image");
  }
  
  $stmt = $con->prepare("
  UPDATE `teachers` SET `name`=?,`email`=?,`password`=?,`phone`=? ,`image`=? WHERE id = ?
  ");
  $stmt->execute(array($name,$email,$password,$phone,$image,$id));
  $count = $stmt->rowCount();
  if($count > 0) {
    echo json_encode(array("status" => "Teacher updated successfully"));
  } else {
    echo json_encode(array("status" => "Error updating teacher"));
  }


?>