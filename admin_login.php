<?php
session_start();
require_once "DataBase.php";

// Prevent undefined array key warnings
$employee_id = $_POST['employee_id'] ?? null;
$password = $_POST['password'] ?? null;

if (!$employee_id || !$password) {
    echo "ログインフォームからアクセスしてください。";
    exit;
}

$sql = "SELECT * FROM m_employee WHERE employee_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$employee_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "社員番号が存在しません。";
    exit;
}

if (!password_verify($password, $user['password_hash'])) {
    echo "パスワードが間違っています。";
    exit;
}

if ($user['role'] !== 'admin') {
    echo "管理者権限がありません。";
    exit;
}

// Login OK
$_SESSION['employee_id'] = $user['employee_id'];
$_SESSION['employee_name'] = $user['employee_name'];
$_SESSION['role'] = $user['role'];

header("Location: Employee_List.php");
exit;
?>
