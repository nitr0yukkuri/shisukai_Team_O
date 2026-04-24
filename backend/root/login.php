$sql = "SELECT id,name,password FROM users WHERE name = :name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue('name',$datas['name'],PDO::PARAM_INT);
$stmt->execute();

if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    if (password_verify($datas['password'],$row['password'])) {
        session_regenerate_id(true);

        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] =  $row['name'];

        header("location:welcome.php"); // Redirect to welcome page
        exit();
    } else {
        $login_err = 'Invalid username or password.';
    }
}else {
    $login_err = 'Invalid username or password.';
}
