<?php
include 'db.php';

$error = '';

if (isset($_POST['save'])) {
    $name = trim($_POST['name']);
    $price = (int)$_POST['price'];
    $year = (int)$_POST['year'];
    $image = trim($_POST['image']);

    if ($name !== '' && $price > 0 && $year > 1900) {
        $stmt = $conn->prepare(
            "INSERT INTO cars (name, price, year, image)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->bind_param("siis", $name, $price, $year, $image);
        $stmt->execute();

        header("Location: index.php");
        exit;
    } else {
        $error = "Мәліметтерді дұрыс толтырыңыз!";
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Машина қосу</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-box">
    <h2>Жаңа машина қосу</h2>

    <p style="color:red">
        <?php echo htmlspecialchars($error); ?>
    </p>

    <form method="POST">
        <input type="text" name="name"
               placeholder="Машина атауы" required>

        <input type="number" name="price"
               placeholder="Бағасы" required>

        <input type="number" name="year"
               placeholder="Шыққан жылы" required>

        <input type="text" name="image"
               placeholder="Сурет атауы: bmw.jpg" required>

        <button type="submit" name="save">Сақтау</button>
    </form>

    <a href="index.php">← Басты бетке қайту</a>
</div>

</body>
</html>