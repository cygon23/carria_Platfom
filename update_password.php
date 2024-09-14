<?php
session_start();
require 'includes/config.php';

// Show errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}
// Retrieve user ID from session
$userId = $_SESSION['user_id'];

$errors = [];
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_passwrd'])) {
    // Capture the new passwords
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if both passwords match
    if ($new_password !== $confirm_password) {
        $errors[] = "Passwords do not match!";
    }

    // Additional password validation (e.g., length, complexity) can be added here
    if (strlen($new_password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Proceed if there are no errors
    if (empty($errors)) {
        // Hash the password before storing it
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        
        // Ensure the session has user_id
        if (!isset($_SESSION['user_id'])) {
            $errors[] = "User session is not set. Please log in.";
        } else {
            $user_id = $_SESSION['user_id'];
        
            // Update the password in the database
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("si", $hashed_password, $user_id);
                
                if ($stmt->execute()) {
                    $success_message = "Password updated successfully!";
                } else {
                    $errors[] = "Failed to update password. Please try again.";
                }
            } else {
                $errors[] = "Database error: " . $conn->error;
            }
        }
    }
}
?>

