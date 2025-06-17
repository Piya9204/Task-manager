<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"));

$title = $data->title;
$description = $data->description;
$deadline = $data->deadline;
$status = $data->status;
$priority = $data->priority;

$sql = "INSERT INTO tasks (title, description, deadline, status, priority)
        VALUES ('$title', '$description', '$deadline', '$status', '$priority')";

$conn->query($sql);
?>
