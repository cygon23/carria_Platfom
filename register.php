<?php

require 'includes/config.php'; // Include database connection



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name= $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // Basic validation (additional validation is encouraged)
    if ($user_type == 'select_role') {
        echo "Please select a valid role.";
        exit;
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $user_type);

    var_dump($_POST);
    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "User registered successfully!";
        header("Location: sign-in.php"); // Redirect to a success page (optional)
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
