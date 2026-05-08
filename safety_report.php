<?php
session_start();

if (!isset($_SESSION['employee_id'])) {
    header("Location: login.html");
    exit;
}

$employee_name = $_SESSION['employee_name'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Safety Report</title>
</head>
<body>
    <h2>Safety Report for <?php echo $employee_name; ?></h2>

    <form action="submit_report.php" method="POST">

        <h3>Personal Safety (本人安否)</h3>
        <label><input type="radio" name="safety_status" value="安全" required> 安全</label><br>
        <label><input type="radio" name="safety_status" value="軽傷"> 軽傷</label><br>
        <label><input type="radio" name="safety_status" value="重傷"> 重傷</label><br><br>

        <h3>Can you commute? (出社可否)</h3>
        <label><input type="radio" name="can_commute" value="1" required> 可能</label><br>
        <label><input type="radio" name="can_commute" value="0"> 不可能</label><br><br>

        <h3>Comment (optional)</h3>
        <textarea name="comment" rows="4" cols="40"></textarea><br><br>

        <button type="submit">報告する</button>
    </form>

</body>
</html>
