<?php

include '../inc/db.php';

$pid = $mysqli->real_escape_string($_GET['pid']);
$output = new stdClass();
$error = new stdClass();
$error->count = 0;

if ($pid === '') {
  $error->message = 'No player id provided';
  $error->count++;
} else if (!is_numeric($pid)) {
  $error->message = 'Player id needs to be a number';
  $error->count++;
}

if ($error->count === 0) {

  $sql = 'DELETE FROM players
          WHERE id = '.$pid.';';

  if ($mysqli->query($sql) === true) {
    http_response_code(200);
    $output->status = http_response_code();
    $output->message = 'Delete Successful';
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