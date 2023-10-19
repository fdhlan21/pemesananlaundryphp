<?php
$conn = mysqli_connect('localhost', 'root', '');
$db = mysqli_select_db($conn, 'webadmin');

$encodedData = file_get_contents('php://input');  // take data from react native fetch API
$data = json_decode($encodedData, true);

