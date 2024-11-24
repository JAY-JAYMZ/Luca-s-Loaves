<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to SQLite database
    $db = new SQLite3('Luca-s-Loaves.db');

    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $date_of_birth = $_POST['date_of_birth'];
    $produce_preferences = $_POST['produce_preferences'];

    // Validate email format and password length
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.location.href = 'register.html';</script>";
        exit();
    }

    if (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long.'); window.location.href = 'register.html';</script>";
        exit();
    }

    // Prepare SQL query to insert user into customer table
    $query = "INSERT INTO customer (first_name, last_name, phone, email, Password, address, city, date_of_birth, produce_preferences) 
              VALUES (:first_name, :last_name, :phone, :email, :password, :address, :city, :date_of_birth, :produce_preferences)";
    
    $stmt = $db->prepare($query);
    $stmt->bindValue(':first_name', $first_name, SQLITE3_TEXT);
    $stmt->bindValue(':last_name', $last_name, SQLITE3_TEXT);
    $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $stmt->bindValue(':address', $address, SQLITE3_TEXT);
    $stmt->bindValue(':city', $city, SQLITE3_TEXT);
    $stmt->bindValue(':date_of_birth', $date_of_birth, SQLITE3_TEXT);
    $stmt->bindValue(':produce_preferences', $produce_preferences, SQLITE3_TEXT);

    // Execute query and handle success or failure
    try {
        $stmt->execute();
        echo "<script>alert('Registration successful!'); window.location.href = 'login.html';</script>";
    } catch (Exception $e) {
        if ($db->lastErrorCode() == 19) { // Unique constraint violation
            echo "<script>alert('Email is already registered. Please use a different email.'); window.location.href = 'register.html';</script>";
        } else {
            echo "<script>alert('An error occurred during registration. Please try again.'); window.location.href = 'register.html';</script>";
        }
    }
}
?>