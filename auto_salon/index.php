<?php
include 'db.php';

$result = $conn->query("SELECT * FROM cars ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Auto Salon</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>AUTO<span>SALON</span></h1>
    <a href="add.php" class="btn">+ Машина қосу</a>
</header>

<section class="hero">
    <h2>Сіздің арманыңыздағы көлік</h2>
    <p>Ең үздік автомобильдер бір жерде</p>
</section>

<h2 class="title">Біздің машиналар</h2>

<div class="cars">

<?php while($car = $result->fetch_assoc()) { ?>

<div class="card">

    <img src="images/<?php echo htmlspecialchars($car['image']); ?>">

    <h3><?php echo htmlspecialchars($car['name']); ?></h3>

    <p>Шыққан жылы: <?php echo $car['year']; ?></p>

    <h4>
        <?php echo number_format($car['price'], 0, '', ' '); ?> ₸
    </h4>

    <a class="delete"
       href="delete.php?id=<?php echo $car['id']; ?>"
       onclick="return confirm('Машинаны өшіресіз бе?')">
       Өшіру
    </a>

</div>

<?php } ?>

</div>

<footer>
    <p>© 2026 AUTO SALON | Барлық құқықтар қорғалған</p>
</footer>

</body>
</html>