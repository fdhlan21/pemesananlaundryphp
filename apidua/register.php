<?php

include('db.php');
$username = $data['username'];
$email = $data['email'];
$password = sha1($data['password']); //password is hashed

$SQL = "SELECT * FROM pengguna WHERE email = '$email' OR username = '$username'";
$exeSQL = mysqli_query($conn, $SQL);
$checkEmailAndUsername =  mysqli_num_rows($exeSQL);

if ($checkEmailAndUsername != 0) {
    $Message = "Email  & Username Sudah Terdaftar!";
} else {

    $InsertQuerry = "INSERT  INTO pengguna(username, email,  password) values('$username', '$email', '$password')";

    $R = mysqli_query($conn, $InsertQuerry);

    if ($R) {
        $Message = "Berhasi Membuat Akun!";
        echo 212;
    } else {
        $Message = "Error";
        echo 505;
    }
}
$response[] = array("Message" => $Message);

echo json_encode($response);
