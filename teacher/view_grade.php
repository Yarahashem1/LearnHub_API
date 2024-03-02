
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
 
  if($users>0){
  $stmt = $con->prepare("
  SELECT g.student_id, g.cource_id, g.grade
  FROM grades g INNER JOIN cources c ON g.cource_id= c.id
  WHERE c.teacher_id =?
  ");
  $stmt->execute(array($teacher_id));
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count = $stmt->rowCount();
  if($count > 0) {
    echo json_encode(array("status" => "success","data" => $data));
  } else {
    echo json_encode(array("status" => "fail"));
  }
}
else{
  echo json_encode(array("status" => "There is no grade added by:  $teacher_id"));
}

?>



