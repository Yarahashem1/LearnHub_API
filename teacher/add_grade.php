
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
    echo json_encode(array( "status" => "The grade for this course is already assigned for this student." ));
  }
  else{
    $stmt = $con->prepare("INSERT INTO grades (cource_id, student_id, grade) VALUES (?,?,?)");

    $stmt->execute(array($cource_id,$student_id,$grade));
    $users = $stmt->rowCount();
  
    if($users > 0) {
      echo json_encode(array("status" => "success"));
    } else {
      echo json_encode(array("status" => "fail"));
    }
  }




?>
