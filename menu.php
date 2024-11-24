<?php
$pdo = new PDO('sqlite:Luca-s-Loaves.db');

$sql = "SELECT * FROM menu";
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>{$row['menuID']}</td>";
    echo "<td><img src='img/order/{$row['menuID']}.jpg' alt='{$row['dish']}' style='width:100px;height:100px;'></td>";
    echo "<td class='dish'>{$row['dish']}</td>";
    echo "<td class='price'>{$row['Price']}</td>";
    echo "<td class='ingredient'>{$row['ingredient']}</td>";
    echo "<td><button class='add-button'>ADD</button></td>";
    echo "</tr>";
}
?>