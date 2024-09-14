<?php
// Include database connection
require 'includes/config.php';

// Start a session
session_start();

// Check if the form is submitted
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']); // Check if "Remember Me" is checked

    // Prepare a secure SQL query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $hashed_password = $user_data['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Store user data in session
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['user_type'] = $user_data['user_type'];

            // If "Remember Me" is checked, set cookies
            if ($remember) {
                // Set cookies to expire in 2 hours (2 * 3600 seconds)
                setcookie('user_email', $email, time() + (3600 * 2), "/");

                // Hash the password and store it in the cookie
                $hashed_password_cookie = password_hash($password, PASSWORD_DEFAULT);
                setcookie('user_password', $hashed_password_cookie, time() + (3600 * 2), "/");
            }

            // Redirect to the appropriate page based on user type
            $user_type = $user_data['user_type'];
            if ($user_type == 'job_seeker') {
                header("Location: index.php");
                exit();
            } elseif ($user_type == 'company') {
                header("Location: dashboard-company.php");
                exit();
            } elseif ($user_type == 'admin') {
                header("Location: dashboard-admin.php");
                exit();
            }
        } else {
            echo "Error: Invalid email or password";
        }
    } else {
        echo "Error: Invalid email or password";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
