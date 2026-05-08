<?php
session_start();
require_once "DataBase.php";

if (!isset($_SESSION['employee_id'])) {
    header("Location: login.html");
    exit;
}

$role = $_SESSION['role'];
$department_id = $_SESSION['department_id'];

if ($role === "employee") {
    // 一般社員 → 自分の部署だけ
    $sql = "SELECT r.*, e.employee_name, e.department_id
            FROM t_safety_report r
            JOIN m_employee e ON r.employee_id = e.employee_id
            WHERE e.department_id = ?
            ORDER BY r.reported_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$department_id]);
} else {
    // 管理者 → 全員
    $sql = "SELECT r.*, e.employee_name, e.department_id
            FROM t_safety_report r
            JOIN m_employee e ON r.employee_id = e.employee_id
            ORDER BY r.reported_at DESC";
    $stmt = $pdo->query($sql);
}

$reports = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Safety Reports</title>
</head>
<body>
    <h2>Safety Reports</h2>

    <?php foreach ($reports as $r): ?>
        <p>
            <strong><?php echo $r['employee_name']; ?></strong><br>
            部署: <?php echo $r['department_id']; ?><br>
            本人安否: <?php echo $r['safety_status']; ?><br>
            出社可否: <?php echo $r['can_commute'] == "1" ? "可能" : "不可能"; ?><br>
            コメント: <?php echo $r['comment']; ?><br>
            時間: <?php echo $r['reported_at']; ?>
        </p>
        <hr>
    <?php endforeach; ?>
</body>
</html>
