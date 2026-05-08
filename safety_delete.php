<?php
require_once "DataBase.php";

// DELETE processing
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM t_safety_report WHERE report_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$delete_id]);

    header("Location: safety_delete.php");
    exit;
}

// Load all safety reports
$sql = "SELECT r.report_id, r.safety_status, r.can_commute, r.comment, 
               r.reported_at, e.employee_name
        FROM t_safety_report r
        JOIN m_employee e ON r.employee_id = e.employee_id
        ORDER BY r.report_id DESC";

$stmt = $pdo->query($sql);
$reports = $stmt->fetchAll();
?>

<table>
    <thead>
        <tr>
            <th>安否</th>
            <th>出勤可否</th>
            <th>名前</th>
            <th>概要記載欄</th>
            <th>報告日時</th>
            <th>削除</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reports as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['safety_status']) ?></td>
            <td><?= $r['can_commute'] == 1 ? "出勤可" : "出勤不可" ?></td>
            <td><?= htmlspecialchars($r['employee_name']) ?></td>
            <td><?= htmlspecialchars($r['comment']) ?></td>
            <td><?= htmlspecialchars($r['reported_at']) ?></td>
            <td>
                <a href="safety_delete.php?delete_id=<?= $r['report_id'] ?>"
                   onclick="return confirm('本当に削除しますか？');">
                   <button>削除</button>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
