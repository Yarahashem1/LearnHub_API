<?php 
  include "../connect.php";
  include "../files/test.php";
  $id = htmlspecialchars(strip_tags($_POST['id']));
  $name = htmlspecialchars(strip_tags($_POST['name']));
  $descript = htmlspecialchars(strip_tags($_POST['descript']));
  $teacher_id = htmlspecialchars(strip_tags($_POST['teacher_id']));
  $student_id = htmlspecialchars(strip_tags($_POST['student_id']));
  $image = uploadImage("image");
  
  $stmt = $con->prepare("SELECT * FROM students
  JOIN grades ON grades.student_id = students.id 
  WHERE students.id = ?");

  $stmt->execute(array($student_id));
  $users = $stmt->rowCount();
 
  if($users>0){
  $stmt = $con->prepare("
  SELECT id,name,image,descript,teacher_id,student_id
  FROM  mycources 
  WHERE student_id =?
  ");
  $stmt->execute(array($student_id));
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count = $stmt->rowCount();
  if($count > 0) {
    echo json_encode(array("status" => "success","data" => $data));
  } else {
    echo json_encode(array("status" => "fail"));
  }
}
else{
  echo json_encode(array("status" => "There is no student id: $student_id"));
}

?>





