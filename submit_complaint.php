<?php
session_start();
include('db.php');

if ($_SESSION['user_role'] != 'user') {
    header("Location: l.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'];
    $complaint_text = $_POST['complaint_text'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO complaints (service_id, user_id, complaint_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $service_id, $user_id, $complaint_text);
    $stmt->execute();

    header("Location: user_dashboard.php?status=complaint_submitted");
}
?>
