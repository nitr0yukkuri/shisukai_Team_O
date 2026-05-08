<?php
require_once "DataBase.php";

$employee_id = $_POST['employee_id'];
$employee_name = $_POST['employee_name'];
$department_id = $_POST['department_id'];
$role = $_POST['role'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO m_employee 
        (employee_id, employee_name, department_id, role, password_hash)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $employee_id,
    $employee_name,
    $department_id,
    $role,
    $hashed_password
]);

echo "Employee registered successfully!";
