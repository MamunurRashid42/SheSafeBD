<?php 
session_start(); 
include('connection.php'); 

$name     = mysqli_real_escape_string($conn, $_POST['name']); 
$phone    = mysqli_real_escape_string($conn, $_POST['phone']); 
$email    = mysqli_real_escape_string($conn, $_POST['email']); 
$password = $_POST['password']; 
$confirm  = $_POST['confirm-password']; 
$question = mysqli_real_escape_string($conn, $_POST['security-question']); 
$answer   = mysqli_real_escape_string($conn, $_POST['security-answer']); 

if (!isset($_POST['terms'])) { 
    echo "<script>alert('Please agree to the Terms and Conditions.'); window.location.href='register.html';</script>"; 
    exit(); 
} 

if ($password !== $confirm) { 
    echo "<script>alert('Passwords do not match!'); window.location.href='register.html';</script>"; 
    exit(); 
} 

$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"); 
if (mysqli_num_rows($check) > 0) { 
    echo "<script>alert('Email already registered. Please log in.'); window.location.href='login-action.php';</script>"; 
    exit(); 
} 

$hashed_password = password_hash($password, PASSWORD_DEFAULT); 

$sql = "INSERT INTO users (name, phone, email, password, security_question, security_answer) 
        VALUES ('$name', '$phone', '$email', '$hashed_password', '$question', '$answer')"; 

if (mysqli_query($conn, $sql)) { 
    header("Location: login.php"); 
    exit(); 
} else { 
    echo "fail"; 
} 
?>
