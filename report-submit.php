<?php
session_start();
include('connection.php');

// Get form values
$name        = mysqli_real_escape_string($conn, $_POST['name']);
$phone       = mysqli_real_escape_string($conn, $_POST['phone']);
$location    = mysqli_real_escape_string($conn, $_POST['location']);
$incident    = mysqli_real_escape_string($conn, $_POST['incident']);
$date        = mysqli_real_escape_string($conn, $_POST['date']);
$description = mysqli_real_escape_string($conn, $_POST['description']);

// File upload
$photo_path = NULL;
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create folder if not exists
    }

    $photo_name = time() . "_" . basename($_FILES["photo"]["name"]);
    $target_file = $target_dir . $photo_name;

    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    if (!in_array($_FILES['photo']['type'], $allowed_types)) {
        echo "<script>alert('Only JPG, PNG, or GIF files are allowed.'); window.location.href='report.html';</script>";
        exit();
    }

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $photo_path = $target_file;
    } else {
        echo "<script>alert('Error uploading file.'); window.location.href='report.html';</script>";
        exit();
    }
}

// SQL insert
$sql = "INSERT INTO reports (name, phone, location, incident, date, description, photo)
        VALUES ('$name', '$phone', '$location', '$incident', '$date', '$description', '$photo_path')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('✅ Success! Your report was submitted.'); window.location.href='report.html';</script>";
} else {
    echo "<script>alert('❌ Error: " . mysqli_error($conn) . "'); window.location.href='report.html';</script>";
}
?>
