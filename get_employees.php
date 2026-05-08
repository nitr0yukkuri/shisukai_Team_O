<?php
require_once "DataBase.php";

$sql = "SELECT employee_id, employee_name FROM m_employee ORDER BY employee_id ASC";
$stmt = $pdo->query($sql);

$employees = $stmt->fetchAll();

echo json_encode($employees);
?>
