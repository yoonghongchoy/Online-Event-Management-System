<?php
session_start();

// initializing variables
$ic = "";
$email    = "";
$errors = array(); 

// connect to the database
include('connect.php');

// USER SIGN UP
if (isset($_POST['sign_up'])) {
  // receive all input values from the form
  $name = $_POST['name'];
  $ic = $_POST['ic'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];
  $address = $_POST['address'];

  // ensure that the form is correctly filled
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($ic)) { array_push($errors, "IC is required"); }
  if (empty($contact)) { array_push($errors, "Contact is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($address)) { array_push($errors, "Address is required"); }

  //check whether the ic and email already exist or not
  $user_check_query = "SELECT * FROM user WHERE ic='$ic' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if exist
    if ($user['ic'] === $ic) {
      array_push($errors, "IC already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Sign up user if there is no error
  if (count($errors) == 0) {
  	$sign_up_query = "INSERT INTO user (name, ic, contact, email, address) 
  			  VALUES('$name', '$ic', '$contact', '$email', '$address')";
  	mysqli_query($db, $sign_up_query);
    $row = mysqli_fetch_assoc(mysqli_query($db, "SELECT user_id from user WHERE ic='$ic' AND email='$email'"));
    $user_id = $row['user_id'];
    $_SESSION['user_id']=$user_id;
  	header('location: Success.php');
  }
}

// USER LOGIN
if (isset($_POST['sign_in'])) {
  $ic = $_POST['ic'];
  $email = $_POST['email'];

  if (empty($ic)) {
    array_push($errors, "IC is required");
  }
  if (empty($email)) {
    array_push($errors, "Email is required");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM user WHERE ic='$ic' AND email='$email'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) > 0) {
      header('location: Success.php');
      $row=mysqli_fetch_assoc($results);
      $user_id = $row["user_id"];
      $name = $row["name"];
      $contact = $row["contact"];
      $address = $row["address"];
      $_SESSION['user_id']= $user_id;
      $_SESSION['name']= $name;
      $_SESSION['contact']= $contact;  
      $_SESSION['address']= $address;
    }else {
      array_push($errors, "Wrong IC/email combination");
    }
  }
}

?>