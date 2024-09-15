<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $skill_id = $_POST['skill_id'];
    $skill_name = $_POST['skill_name'];
    $proficiency_level = $_POST['proficiency_level'];

    // Update the skill in the database
    $stmt = $conn->prepare("UPDATE skills SET skill_name = ?, proficiency_level = ? WHERE id = ?");
    $stmt->bind_param("ssi", $skill_name, $proficiency_level, $skill_id);

    if ($stmt->execute()) {
        echo "Skill updated successfully!";
        header("Location: skills_dashboard.php"); // Redirect to the dashboard or skill list page
    } else {
        echo "Error updating skill: " . $stmt->error;
    }

    $stmt->close();
}
?>
