<?php

include "../connect.php";
include "../files/test.php";
// delete student

$id = htmlspecialchars(strip_tags($_POST['id']));
$imagename = htmlspecialchars(strip_tags($_POST['image']));

  
  // delete grades first                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
  // $stmt = $con->prepare("DELETE FROM grades WHERE cource_id IN (SELECT id FROM cources WHERE student_id = ?)");
  // $stmt->execute(array($id));
  // $count = $stmt->rowCount();

 // delete mycourses                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
  $stmt = $con->prepare("DELETE FROM mycources WHERE student_id = ?");
  $stmt->execute(array($id));
  $count = $stmt->rowCount();

  // delete the student
  $stmt = $con->prepare( " DELETE FROM students WHERE id = ?");
  $stmt->execute(array($id));
  $count = $stmt->rowCount();


  if($count > 0) {
    delete_file("images",$imagename);
    echo json_encode(array("status" => "success"));
  } else {
    echo json_encode(array("status" => "fail"));
  }

?>