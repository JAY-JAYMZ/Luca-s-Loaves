<?php
$pdo = new PDO('sqlite:Luca-s-Loaves.db');
$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$totalPrice = $data['totalPrice'];

foreach ($data['orders'] as $order) {
    $stmt = $pdo->prepare("INSERT INTO orders (email, dish, price, TotalPrice, quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$email, $order['dish'], $order['price'], $totalPrice, $order['quantity']]);
}

echo json_encode(["success" => true]);
?>