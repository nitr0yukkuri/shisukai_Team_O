<?php
require_once "DataBase.php";

$employee_name = $_GET['name'] ?? null;
$employee_id   = $_GET['id'] ?? null;

$sql = "SELECT 
            e.employee_id, 
            e.employee_name, 
            e.role,
            (
                SELECT safety_status
                FROM t_safety_report
                WHERE employee_id = e.employee_id
                ORDER BY reported_at DESC
                LIMIT 1
            ) AS safety_status
        FROM m_employee e
        WHERE 1=1";

$params = [];

if ($employee_name) {
    $sql .= " AND e.employee_name LIKE ?";
    $params[] = "%$employee_name%";
}

if ($employee_id) {
    $sql .= " AND e.employee_id = ?";
    $params[] = $employee_id;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

echo json_encode($stmt->fetch());
