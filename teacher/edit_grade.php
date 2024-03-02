
<?php 
  include "../connect.php";
  $teacher_id=htmlspecialchars(strip_tags($_POST['id']));
  $grade = htmlspecialchars(strip_tags($_POST['grade']));
  $cource_id = htmlspecialchars(strip_tags($_POST['cource_id']));
  $student_id = htmlspecialchars(strip_tags($_POST['student_id']));
  
  $stmt = $con->prepare("SELECT cources.id, cources.name FROM cources 
  JOIN teachers ON cources.teacher_id = teachers.id 
  WHERE teachers.id = ?");

  $stmt->execute(array($teacher_id));
  $users = $stmt->rowCount();
 

   
  // check if a grade already exists for the same course and student
  $stmt = $con->prepare("SELECT *FROM grades WHERE cource_id = ? AND student_id = ?");
  $stmt->execute(array($cource_id,$student_id));
  $users = $stmt->rowCount();


  if($users > 0) {
    $stmt = $con->prepare("UPDATE grades SET grade = ? WHERE cource_id = ? AND student_id = ?");
    $stmt->execute(array($grade,$cource_id,$student_id));
    $users = $stmt->rowCount();
  
    if($users > 0) {
      echo json_encode(array("status" => "Grade updated successfully"));
    } else {
      echo json_encode(array("status" => "Error updating grade"));
    }
  }
  else{
  
    echo json_encode(array( "status" => "No grade found for the specified course and student." ));
  }




?>
