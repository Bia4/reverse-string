<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Invalid request");
}

$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($name) || empty($email) || empty($password)) {
    echo "error";
    exit;
}

$check = $conn->prepare("SELECT id FROM register WHERE email=?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if($check->num_rows > 0){
    echo "exists";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO register (name,email,password) VALUES (?,?,?)");
$stmt->bind_param("sss", $name, $email, $hashedPassword);

if($stmt->execute()){
    echo "success";
} else {
    echo "error";
}
?>