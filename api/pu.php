<?php

include '../inc/db.php';

$pu = $_GET['pu'];
$pu2 = $_GET['pu2'];
$pid = $_GET['pid'];
$output = new stdClass();
$error = new stdClass();
$error->count = 0;

if ($pid === '') {
  $error->message = "No player id provided";
  $error->count++;
} else if (!is_numeric($pid)) {
  $error->message = "Player id needs to be a number";
  $error->count++;
} else if ($pu === '' && $pu2 === '') {
  $error->message = "No pu try1 or pu try2 provided";
  $error->count++;
}

if (is_numeric($pu) && is_numeric($pu2) && $pu2 >= 0 && $pu >= 0) {
  $sql = "UPDATE players
          SET pu = '".$pu."',
          pu2 = '".$pu2."'
          WHERE id = ".$pid;
} else if (is_numeric($pu2) && $pu2 >= 0) {
  $sql = "UPDATE players
          SET pu2 = '".$pu2."'
          WHERE id = ".$pid;
} else if (is_numeric($pu) && $pu >= 0) {
  $sql = "UPDATE players
          SET pu = '".$pu."'
          WHERE id = ".$pid;
} else {
  $error->message = "pu try1 and pu try2 need to be numbers";
  $error->count++;
}

if ($error->count === 0) {

  if ($mysqli->query($sql) === true) {
    http_response_code(200);
    $output->status = http_response_code();
    $output->message = "Update Successful";
    echo json_encode($output);
  } else {
    http_response_code(400);
    $output->status = http_response_code();
    $error->message = $mysqli->error;
    $output->error = $error;
    echo json_encode($output);
  }
} else {
  http_response_code(400);
  $output->status = http_response_code();
  $output->error = $error;
  echo json_encode($output);
}
?>