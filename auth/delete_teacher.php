<?php

include "../connect.php";
include "../files/test.php";
// delete teacher

$id = htmlspecialchars(strip_tags($_POST['id']));
$imagename = htmlspecialchars(strip_tags($_POST['image']));

  // delete grades first                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
  // $stmt = $con->prepare("DELETE FROM grades WHERE cource_id IN (SELECT id FROM cources WHERE teacher_id = ?)");
  // $stmt->execute(array($id));
  // $count = $stmt->rowCount();

 // delete mycourses                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
  $stmt = $con->prepare("DELETE FROM mycources WHERE teacher_id = ?");
  $stmt->execute(array($id));
  $count = $stmt->rowCount();

  // delete courses                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
  $stmt = $con->prepare("DELETE FROM cources WHERE teacher_id = ?");
  $stmt->execute(array($id));
  $count = $stmt->rowCount();


  // delete the teacher
  $stmt = $con->prepare( "
  DELETE FROM teachers WHERE id = ?
  ");
  $stmt->execute(array($id));
  $count = $stmt->rowCount();


  if($count > 0) {
    delete_file("images/",$imagename);
    echo json_encode(array("status" => "success"));
  } else {
    echo json_encode(array("status" => "fail"));
  }

?>