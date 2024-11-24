<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Connect to SQLite database
    $db = new SQLite3('Luca-s-Loaves.db');

    // Get form inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check customer table
    $customer_query = "SELECT * FROM customer WHERE email = :email AND password = :password";
    $stmt = $db->prepare($customer_query);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $customer_result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if ($customer_result) {
        // If matched in customer table, redirect to index.html
        header("Location: Home.html");
        exit();
    } else {
        // Check Administrator table
        $admin_query = "SELECT * FROM Administrator WHERE email = :email AND password = :password";
        $stmt = $db->prepare($admin_query);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $admin_result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

        if ($admin_result) {
            // If matched in Administrator table, redirect to Administrator.html
            header("Location: admin.html");
            exit();
        } else {
            // No match found, show alert and redirect back to login.html
            echo "<script>alert('Incorrect email or password. Please try again.'); window.location.href = 'login.html';</script>";
        }
    }
}
?>