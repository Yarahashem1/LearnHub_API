<?php 
  include "../connect.php";
  include "../files/test.php";
  $name = htmlspecialchars(strip_tags($_POST['name']));
  $descript = htmlspecialchars(strip_tags($_POST['descript']));
  $teacher_id = htmlspecialchars(strip_tags($_POST['teacher_id']));
  //$student_id = htmlspecialchars(strip_tags($_POST['student_id']));
  $id = htmlspecialchars(strip_tags($_POST['id']));
  

  //new upload
  if(isset ($_FILES['image'])){
    delete_file("images/",$image);
    $image = uploadImage("image");
  }

  $stmt = $con->prepare("
  UPDATE `mycources` SET `name`=?,`descript`=?,`teacher_id`=? WHERE id = ?
  ");
  $stmt->execute(array($name,$descript,$teacher_id,$id));
  $count = $stmt->rowCount();
  
  $stmt = $con->prepare("
  UPDATE `cources` SET `name`=?,`descript`=?,`teacher_id`=? WHERE id = ?
  ");
  $stmt->execute(array($name,$descript,$teacher_id,$id));
  $count = $stmt->rowCount();
  if($count > 0) {
    echo json_encode(array("status" => "Course updated successfully"));
  } else {
    echo json_encode(array("status" => "Error updating course "));
  }


?>