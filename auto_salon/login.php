<?php
include 'db.php';

$error = '';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT * FROM users WHERE email = ?"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Email немесе пароль қате!";
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
<meta charset="UTF-8">
<title>Вход</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-box">
<h2>Аккаунтқа кіру</h2>

<p style="color:red"><?= htmlspecialchars($error) ?></p>

<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Пароль" required>

<button name="login">Кіру</button>
</form>

<a href="register.php">Тіркелу</a>
</div>

</body>
</html>