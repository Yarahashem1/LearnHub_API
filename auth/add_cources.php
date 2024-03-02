

<?php 
  include "../connect.php";
  include "../files/test.php";

  $name = htmlspecialchars(strip_tags($_POST['name']));
  $descript = htmlspecialchars(strip_tags($_POST['descript']));
  $teacher_id = htmlspecialchars(strip_tags($_POST['teacher_id']));
  //$student_id = htmlspecialchars(strip_tags($_POST['student_id']));
  $id = htmlspecialchars(strip_tags($_POST['id']));
  $image = uploadImage("image");
  
  $stmt = $con->prepare("
  INSERT INTO `cources`(`name`, `descript`, `teacher_id`,  `image`,`id`) VALUES (?,?,?,?,?)
  ");


  $stmt->execute(array($name,$descript,$teacher_id,$image,$id));
  $users = $stmt->rowCount();
  if($users > 0) {
    echo json_encode(array("status" => "success"));
  } else {
    echo json_encode(array("status" => "fail"));
  }


?>
