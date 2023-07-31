<?php
session_start();
include '../../assets/constant/config.php';

// try {
//        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (isset($_POST["btn_web"]))
// print_r($_POST); exit;

{
  //extract($_POST);
  $target_dir = "../../assets/img/";
  $website_logo = basename($_FILES["website_image"]["name"]);
  if ($_FILES["website_image"]["tmp_name"] != '') {
    $image = $target_dir . basename($_FILES["website_image"]["name"]);
    if (move_uploaded_file($_FILES["website_image"]["tmp_name"], $image)) {

      @unlink("../../assets/img/" . $_POST['old_website_image']);
    } else {
      //echo "Sorry, there was an error uploading your file.";
    }
  } else {
    $website_logo = $_POST['old_website_image'];
  }

  $login_logo = basename($_FILES["login_image"]["name"]);
  if ($_FILES["login_image"]["tmp_name"] != '') {
    $image = $target_dir . basename($_FILES["login_image"]["name"]);
    if (move_uploaded_file($_FILES["login_image"]["tmp_name"], $image)) {

      @unlink("../../assets/img/" . $_POST['old_login_image']);
    } else {
      //echo "Sorry, there was an error uploading your file.";
    }
  } else {
    $login_logo = $_POST['old_login_image'];
  }


  $background_login_image = basename($_FILES["back_login_image"]["name"]);
  if ($_FILES["back_login_image"]["tmp_name"] != '') {
    $image = $target_dir . basename($_FILES["back_login_image"]["name"]);
    if (move_uploaded_file($_FILES["back_login_image"]["tmp_name"], $image)) {

      @unlink("../../assets/img/" . $_POST['old_back_login_image']);
    } else {
      $background_login_image = $_POST['old_back_login_image'];
    }
  } else {
    $background_login_image = $_POST['old_back_login_image'];
  }

  // qr code start

  $pay_qrcode = basename($_FILES["back_qr_image"]["name"]);
  if ($_FILES["back_qr_image"]["tmp_name"] != '') {
    $image = $target_dir . basename($_FILES["back_qr_image"]["name"]);
    if (move_uploaded_file($_FILES["back_qr_image"]["tmp_name"], $image)) {

      @unlink("../../assets/img/" . $_POST['old_qr_image']);
    } else {
      //echo "Sorry, there was an error uploading your file.";
    }
  } else {
    $pay_qrcode = $_POST['old_qr_image'];
  }

  // qr code end

  //echo "UPDATE `devotees` SET `dname`='".$_POST['dname']."',`date`='".$_POST['date']."',`phone`='".$_POST['phone']."',`state`='".$_POST['state']."',`status`='".$_POST['status']."' WHERE id='".$_POST['id']."' ";exit;

  $stmt = $db->prepare("UPDATE `manage_website` SET `title`='" . $_POST['title'] . "',`currency_symbol`='" . $_POST['currency_symbol'] . "',`login_logo`='" . $login_logo . "',`website_logo`='" . $website_logo . "',`background_login_image`='" . $background_login_image . "',`pay_qrcode`='" . $pay_qrcode . "',`footer`='" . $_POST['footer'] . "'  WHERE id='" . $_POST['id'] . "' ");

  // print_r($stmt); exit;

  $stmt->execute();
  // print_r($stmt); exit;



  $_SESSION['update'] = "update";


  header("location:../manage_website.php");
  // header("location:../manage_news_category.php" );  
}
