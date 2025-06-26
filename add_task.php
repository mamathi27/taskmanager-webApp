<?php
session_start();
include 'db.php';

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Check if form submitted
if (isset($_POST['add_task'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $deadline = $_POST['deadline'];
    $user_id = $_SESSION['user_id'];

    // Insert into tasks table
    $query = "INSERT INTO tasks (user_id, title, description, deadline) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $user_id, $title, $description, $deadline);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Redirect back to dashboard
        exit();
    } else {
        echo "<script>alert('Failed to add task. Try again.'); window.location.href='dashboard.php';</script>";
    }
} else {
    // If accessed without submitting form
    header("Location: dashboard.php");
    exit();
}
?>
