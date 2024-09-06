<?php
try {
    $pdo = new PDO('postgresql:host=127.0.0.1;port=5432;dbname=gestion', 'user_gestion', '123');
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
