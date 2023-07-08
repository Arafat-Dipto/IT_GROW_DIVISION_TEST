<?php

$servername = 'localhost';
$username   = 'root';
$password   = '';
$dbname     = 'test';


$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
    die('Connection failed: '. $conn->connect_error);
}

$jsonData  = file_get_contents('data.json');
$dataArray = json_decode($jsonData, true);

$tablename = 'events';
$statement = $conn->prepare("INSERT INTO events (participation_id,employee_name,employee_mail,event_id,event_name,participation_fee,event_date) VALUES (?,?,?,?,?,?,?)");


foreach($dataArray as $data) {
    $participation_id  = $data['participation_id'];
    $employee_name     = $data['employee_name'];
    $employee_mail     = $data['employee_mail'];
    $event_id          = $data['event_id'];
    $event_name        = $data['event_name'];
    $participation_fee = $data['participation_fee'];
    $event_date        = $data['event_date'];

    $statement->bind_param('sssssss', $participation_id, $employee_name, $employee_mail, $event_id, $event_name, $participation_fee, $event_date);

    $statement->execute();
}

$statement->close();

$conn->close();
