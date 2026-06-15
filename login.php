<?php
session_start();
include "db.php";


$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


if (empty($email) || empty($password)) {
    echo "notfound";
    exit;
}

$stmt = $conn->prepare("SELECT id, name, password FROM register WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 1){

    $user = $result->fetch_assoc();

    if(password_verify($password, $user['password'])){

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        echo "success";
    } else {
        echo "wrong";
    }

} else {
    echo "notfound";
}
?>