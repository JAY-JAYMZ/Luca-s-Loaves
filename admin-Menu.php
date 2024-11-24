<?php
// 数据库连接
$db = new SQLite3('Luca-s-Loaves.db');

// 处理 CRUD 请求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    // 创建新记录
    if ($action === 'create') {
        $stmt = $db->prepare("INSERT INTO menu (dish, Price, ingredient) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $_POST['dish']);
        $stmt->bindValue(2, $_POST['Price']);
        $stmt->bindValue(3, $_POST['ingredient']);
        $stmt->execute();
    }

    // 更新记录
    elseif ($action === 'update') {
        $stmt = $db->prepare("UPDATE menu SET dish = ?, Price = ?, ingredient = ? WHERE menuID = ?");
        $stmt->bindValue(1, $_POST['dish']);
        $stmt->bindValue(2, $_POST['Price']);
        $stmt->bindValue(3, $_POST['ingredient']);
        $stmt->bindValue(4, $_POST['menuID']);
        $stmt->execute();
    }

    // 删除记录
    elseif ($action === 'delete') {
        $stmt = $db->prepare("DELETE FROM menu WHERE menuID = ?");
        $stmt->bindValue(1, $_POST['menuID']);
        $stmt->execute();
    }
}

// 获取数据
$results = $db->query("SELECT * FROM menu");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu management page</title>
    <link rel="stylesheet" href="css/admin-all.css">
</head>
<body>
    <header>
        <h1>Menu management page</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>dish</th>
                    <th>Price</th>
                    <th>ingredient</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)): ?>
                    <tr>
                        <form method="POST">
                            <td><input type="hidden" name="menuID" value="<?= $row['menuID'] ?>"><?= $row['menuID'] ?></td>
                            <td><input type="text" name="dish" value="<?= $row['dish'] ?>"></td>
                            <td><input type="number" step="0.01" name="Price" value="<?= $row['Price'] ?>"></td>
                            <td><input type="text" name="ingredient" value="<?= $row['ingredient'] ?>"></td>
                            <td>
                            <button type="submit" name="action" value="update">Update</button>
                                <button type="submit" name="action" value="delete">Delete</button>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <form method="POST">
                        <td>new</td>
                        <td><input type="text" name="dish"></td>
                        <td><input type="number" step="0.01" name="Price"></td>
                        <td><input type="text" name="ingredient"></td>
                        <td>
                            <button type="submit" name="action" value="create">Add</button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
        <div class="back-button">
            <a href="admin.html">BACK</a>
        </div>
    </main>
</body>
</html>