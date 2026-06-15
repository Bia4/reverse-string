<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit;
}


$original_name = $_SESSION['user_name'];


$length = 0;
while (isset($original_name[$length])) {
    $length++;
}


$reversed_name = "";
for ($i = $length - 1; $i >= 0; $i--) {
    $reversed_name .= $original_name[$i];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard-container">
    <div class="dashboard-card">
        
        <h1>Welcome Back!</h1>
        <p>Hello, <strong><?php echo htmlspecialchars($reversed_name); ?></strong>. You have successfully logged into your system.</p>
        
        <a href="logout.php" class="btn-logout">Log Out</a>
        
    </div>
</div>

</body>
</html>