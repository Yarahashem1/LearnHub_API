<?php 
  include "../connect.php";

  $id = htmlspecialchars(strip_tags($_POST['id']));
  $password = htmlspecialchars(strip_tags($_POST['password']));
  $stmt = $con->prepare("
  SELECT * FROM students where id = ? and password = ? 
  "
   
  );
  $stmt->execute(array($id,$password));
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  $users = $stmt->rowCount();
  if($users > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
  } else {
    echo json_encode(array("status" => "fail"));
  }

  

?>
