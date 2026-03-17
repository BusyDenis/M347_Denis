<?php
$dbHost = 'db';
$dbUser = 'root';
$dbPass = 'kn02rootpw';
$dbName = 'm347';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>DB Verbindungstest</title>
</head>
<body>
  <h1>DB Verbindungstest</h1>
  <?php if ($conn->connect_error): ?>
    <p>Verbindung fehlgeschlagen: <?php echo htmlspecialchars($conn->connect_error); ?></p>
  <?php else: ?>
    <p>Verbindung erfolgreich zu MariaDB auf Host "<?php echo htmlspecialchars($dbHost); ?>".</p>
    <?php
    $result = $conn->query("SELECT VERSION() AS version");
    if ($result && $row = $result->fetch_assoc()) {
        echo '<p>MariaDB Version: ' . htmlspecialchars($row['version']) . '</p>';
    }
    ?>
  <?php endif; ?>
</body>
</html>
