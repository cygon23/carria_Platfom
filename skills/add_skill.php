
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'includes/config.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $skills = $_POST['skills']; // This is an array
    $proficiency_level = $_POST['proficiency_level'];
    $status = $_POST['status'];

    // Get user_id from session
    $user_id = $_SESSION['user_id'];

    // Check if at least one skill is selected
    if (empty($skills) || empty($proficiency_level) || empty($status)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Prepare SQL statement to insert each skill
    $stmt = $conn->prepare("INSERT INTO skills (skill_name, proficiency_level, status, user_id) VALUES (?, ?, ?, ?)");

    // Loop through each skill and insert it into the database
    foreach ($skills as $skill) {
        $stmt->bind_param("ssss", $skill, $proficiency_level, $status, $user_id);

        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
            exit;
        }
    }

    // echo "Skills added successfully!";
    header("Location: skills.php"); // Redirect to a success page
    $stmt->close();
    $conn->close();
}
?>


