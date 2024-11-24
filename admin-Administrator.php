<?php

$db = new SQLite3('Luca-s-Loaves.db');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

  
    if ($action === 'create') {
        $stmt = $db->prepare("INSERT INTO Administrator (last_name, first_name, phone, email, password, address, city, date_of_birth, produce_preferences) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $_POST['last_name']);
        $stmt->bindValue(2, $_POST['first_name']);
        $stmt->bindValue(3, $_POST['phone']);
        $stmt->bindValue(4, $_POST['email']);
        $stmt->bindValue(5, $_POST['password']);
        $stmt->bindValue(6, $_POST['address']);
        $stmt->bindValue(7, $_POST['city']);
        $stmt->bindValue(8, $_POST['date_of_birth']);
        $stmt->bindValue(9, $_POST['produce_preferences']);
        $stmt->execute();
    }

    
    elseif ($action === 'update') {
        $stmt = $db->prepare("UPDATE Administrator SET last_name = ?, first_name = ?, phone = ?, email = ?, password = ?, address = ?, city = ?, date_of_birth = ?, produce_preferences = ? WHERE AdministratorID = ?");
        $stmt->bindValue(1, $_POST['last_name']);
        $stmt->bindValue(2, $_POST['first_name']);
        $stmt->bindValue(3, $_POST['phone']);
        $stmt->bindValue(4, $_POST['email']);
        $stmt->bindValue(5, $_POST['password']);
        $stmt->bindValue(6, $_POST['address']);
        $stmt->bindValue(7, $_POST['city']);
        $stmt->bindValue(8, $_POST['date_of_birth']);
        $stmt->bindValue(9, $_POST['produce_preferences']);
        $stmt->bindValue(10, $_POST['AdministratorID']);
        $stmt->execute();
    }

   
    elseif ($action === 'delete') {
        $stmt = $db->prepare("DELETE FROM Administrator WHERE AdministratorID = ?");
        $stmt->bindValue(1, $_POST['AdministratorID']);
        $stmt->execute();
    }
}


$results = $db->query("SELECT * FROM Administrator");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator management interface</title>
    <link rel="stylesheet" href="css/admin-all.css">
</head>
<body>
    <header>
        <h1>Administrator management interface</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Date of Birth</th>
                    <th>Preferences</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)): ?>
                    <tr>
                        <form method="POST">
                            <td><input type="hidden" name="AdministratorID" value="<?= $row['AdministratorID'] ?>"><?= $row['AdministratorID'] ?></td>
                            <td><input type="text" name="last_name" value="<?= $row['last_name'] ?>"></td>
                            <td><input type="text" name="first_name" value="<?= $row['first_name'] ?>"></td>
                            <td><input type="text" name="phone" value="<?= $row['phone'] ?>"></td>
                            <td><input type="email" name="email" value="<?= $row['email'] ?>"></td>
                            <td><input type="text" name="password" value="<?= $row['Password'] ?>"></td>
                            <td><input type="text" name="address" value="<?= $row['address'] ?>"></td>
                            <td><input type="text" name="city" value="<?= $row['city'] ?>"></td>
                            <td><input type="text" name="date_of_birth" value="<?= $row['date_of_birth'] ?>"></td>
                            <td><input type="text" name="produce_preferences" value="<?= $row['produce_preferences'] ?>"></td>
                            <td>
                                <button type="submit" name="action" value="update">Update</button>
                                <button type="submit" name="action" value="delete">Delete</button>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <form method="POST">
                        <td>New</td>
                        <td><input type="text" name="last_name"></td>
                        <td><input type="text" name="first_name"></td>
                        <td><input type="text" name="phone"></td>
                        <td><input type="email" name="email"></td>
                        <td><input type="text" name="password"></td>
                        <td><input type="text" name="address"></td>
                        <td><input type="text" name="city"></td>
                        <td><input type="text" name="date_of_birth"></td>
                        <td><input type="text" name="produce_preferences"></td>
                        <td>
                            <button type="submit" name="action" value="create">Add</button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
        <div class="back-button">
            <a href="admin.html">Back</a>
        </div>
    </main>
</body>
</html>