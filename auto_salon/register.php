<?php
include 'db.php';

$error = '';

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (name, email, password)
         VALUES (?, ?, ?)"
    );

    $stmt->bind_param("sss", $name, $email, $hash);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Бұл email тіркелген!";
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
<meta charset="UTF-8">
<title>Регистрация</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-box">
<h2>Тіркелу</h2>

<p style="color:red"><?= htmlspecialchars($error) ?></p>

<form method="POST">
<input name="name" placeholder="Атыңыз" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Пароль" required>

<button name="register">Тіркелу</button>
</form>

<a href="login.php">Аккаунтыңыз бар ма? Кіру</a>
</div>

</body>
</html>