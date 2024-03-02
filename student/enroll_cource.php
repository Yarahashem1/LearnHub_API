

<?php 
  include "../connect.php";
  include "../files/test.php";

  $name = htmlspecialchars(strip_tags($_POST['name']));
  $descript = htmlspecialchars(strip_tags($_POST['descript']));
  $teacher_id = htmlspecialchars(strip_tags($_POST['teacher_id']));
  $student_id = htmlspecialchars(strip_tags($_POST['student_id']));
  $id = htmlspecialchars(strip_tags($_POST['id']));
  $image = uploadImage("image");

  $stmt = $con->prepare("SELECT * FROM grades 
  JOIN students ON grades.student_id = students.id 
  WHERE students.id = ?");

  $stmt->execute(array($student_id));
  $users = $stmt->rowCount();
 
  // check if a cource already exists for the same course and student
  $stmt = $con->prepare("SELECT *FROM mycources WHERE id = ? AND student_id = ?");
  $stmt->execute(array($id,$student_id));
  $users = $stmt->rowCount();
  if($users > 0) {
    echo json_encode(array( "status" => "The course is already assigned for this student." ));
  }
  else{
    $stmt = $con->prepare("
    INSERT INTO `mycources`(`name`, `descript`, `teacher_id`, `student_id`, `image`,`id`) VALUES (?,?,?,?,?,?)
    ");
    $stmt->execute(array($name,$descript,$teacher_id,$student_id,$image,$id));
    $users = $stmt->rowCount();
    if($users > 0) {
      echo json_encode(array("status" => "success"));
    } else {
      echo json_encode(array("status" => "fail"));
    }
  } 
?>
