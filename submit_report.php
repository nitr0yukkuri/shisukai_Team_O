<?php
session_start();
require_once "DataBase.php";

if (!isset($_SESSION['employee_id'])) {
    header("Location: login.html");
    exit;
}

$employee_id = $_SESSION['employee_id'];
$safety_status = $_POST['safety_status'];
$can_commute = $_POST['can_commute'];
$comment = $_POST['comment'];

$sql = "INSERT INTO t_safety_report (employee_id, safety_status, can_commute, comment)
        VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$employee_id, $safety_status, $can_commute, $comment]);

header("Location: report_done.php");
exit;
