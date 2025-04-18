<?php
session_start();
include('connection.php');


$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password']; 


$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
       
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];

       
        echo "<script>alert('Login successful!'); window.location.href='home.html';</script>";
        exit;
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href='login-action.php';</script>";
    }
} else {
    echo "<script>alert('No user found with that email.'); window.location.href='login-action.php';</script>";
}
?>
