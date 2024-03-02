

<?php 
  include "../connect.php";
  include "../files/test.php";
  $name = htmlspecialchars(strip_tags($_POST['name']));
  $email = htmlspecialchars(strip_tags($_POST['email']));
  $password = htmlspecialchars(strip_tags($_POST['password']));
  $phone = htmlspecialchars(strip_tags($_POST['phone']));
  $id = htmlspecialchars(strip_tags($_POST['id']));
  $image = uploadImage("image");
  
  // define validation functions
function validateName($name)
{
  return strlen($name) >= 3;
}

function validateEmail($email)
{
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password)
{
  return strlen($password) >= 6 && strlen($password) <= 12 ;
}

function validatePhone($phone)
{
  return preg_match('/^\d{10}$/', $phone);
}




  // validate the form data
  $errors = array();
  if (!validateName($name)) {
    $errors[] = 'Name must be at least 3 characters.';
  }
  if (!validateEmail($email)) {
    $errors[] = 'Invalid email.';
  }
  if (!validatePassword($password)) {
    $errors[] = 'Password must be between 6 and 12 characters.';
  }
  if (!validatePhone($phone)) {
    $errors[] = 'Phone must be 10 digits.';
  }
 
  $stmt = $con->prepare("
  INSERT INTO `students`(`name`, `email`, `password`, `phone`, `image`,`id`) VALUES (?,?,?,?,?,?)
  ");

  if (count($errors) > 0) {
      echo json_encode(array("status" => $errors));
    exit;
  }

  $stmt->execute(array($name,$email,$password,$phone,$image,$id));
  $users = $stmt->rowCount();
  if($users > 0) {
    echo json_encode(array("status" => "success"));
  } else {
    echo json_encode(array("status" => "fail"));
  }


?>
