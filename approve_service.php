<?php
session_start();
include('db.php');

// Only LGU can approve
if ($_SESSION['user_role'] != 'lgu') {
    header("Location: lphp");
    exit();
}

if (isset($_POST['approve'])) {
    $service_id = $_POST['service_id'];
    $conn->query("UPDATE transport_services SET approved_by_lgu = 1 WHERE id = $service_id");
    header("Location: lgu_dashboard.php");
} elseif (isset($_POST['reject'])) {
    $service_id = $_POST['service_id'];
    $conn->query("DELETE FROM transport_services WHERE id = $service_id");
    header("Location: lgu_dashboard.php");
}
?>
