<?php

include('db.php');

$email = $data['email'];
$password = sha1($data['password']); //password is hashed

$SQL = "SELECT * FROM pengguna WHERE email = '$email'";
$exeSQL = mysqli_query($conn, $SQL);
$checkemail =  mysqli_num_rows($exeSQL);

if ($checkemail != 0) {
    $arrayu = mysqli_fetch_array($exeSQL);
    if ($arrayu['password'] != $password) {
        echo 404;
    } else {
        $Message = "Berhasil login!";
        echo json_encode((array("SUCCESS" => true, "LOGIN SUCCESS")));
    }
} else {
    $Message = "Tidak ada akun0_0";
    echo json_encode((array("SUCCESS" => false, "LOGIN TIDAK SUCCESS")));
    echo 404;
}

$response[] = array("Message" => $Message);
echo json_encode($response);
