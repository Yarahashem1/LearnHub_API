

<?php 
  include "../connect.php";

  $student_id= htmlspecialchars(strip_tags($_POST['student_id']));

  $stmt = $con->prepare("
  SELECT `cource_id`, `grade` FROM `grades` WHERE `student_id` = ?
  ");
  $stmt->execute(array($student_id));
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count = $stmt->rowCount();

  if($count > 0) {
    echo json_encode(array("status" => "success","data" => $data));
  } else {
    echo json_encode(array("status" => "fail"));
  }


?>