<?php
session_start();

// If not logged in → send back to admin login
if (!isset($_SESSION['employee_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: frontwebsiteAdminLogin.html");
    exit;
}

$admin_name = $_SESSION['employee_name'];
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社員一覧画面</title>
    <link rel="stylesheet" href="./css/EmployeeListScreen.css">
</head>

<body>

    <div class="app-container">
        <header>
            <h1>社員一覧</h1>
            <div class="user-info">
                <img src="../image/Vector.png" alt="ユーザー" class="user-icon">
                <?php echo htmlspecialchars($admin_name); ?>
            </div>
        </header>

        <div class="main-content">
            <aside class="sidebar">
                <button type="button" onclick="goToMenu()">メニュー画面へ</button>
                <button class="active" type="button" onclick="location.href='EmployeeDetailScreen.html'">社員詳細</button>
                <button type="button" onclick="location.href='SafetyListScreen.html'">社員安否一覧</button>
                <button>&nbsp;</button>
                <button>&nbsp;</button>
                <button>&nbsp;</button>
            </aside>

            <main class="content">
                <h2>社員検索・一覧</h2>

                <div class="search-form">
                    <div class="input-group">
                        <label>社員名</label>
                        <input type="text" id="searchName" placeholder="🔍">
                    </div>
                    <div class="input-group">
                        <label>社員番号</label>
                        <input type="text" id="searchId" placeholder="🔍">
                    </div>
                </div>

                <div class="list-container">
                    <table>
                        <thead>
                            <tr>
                                <th>社員名</th>
                                <th>社員番号</th>
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="./js/Employee_List.js"></script>
    <script>
        function goToMenu() {
            window.location.href = 'frontwebsiteAdminLogin.html';
        }
    </script>
</body>

</html>
