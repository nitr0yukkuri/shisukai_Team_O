<?php
require_once "DataBase.php";

$employee_id = $_POST['employee_id'];
$password = $_POST['password'];

$sql = "SELECT * FROM m_employee WHERE employee_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$employee_id]);
$userData = $stmt->fetch();

if ($userData) {

    // THIS PART IS IMPORTANT
    if (password_verify($password, $userData['password_hash'])) {

        session_start();
        $_SESSION['employee_id'] = $userData['employee_id'];
        $_SESSION['employee_name'] = $userData['employee_name'];
        $_SESSION['role'] = $userData['role'];
        $_SESSION['department_id'] = $userData['department_id'];

        header("Location: safety_report.php");
        exit;

    } else {
        echo "Incorrect password.";
    }

} else {
    echo "Employee ID not found.";
}
