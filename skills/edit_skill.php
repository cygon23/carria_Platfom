<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}

require 'includes/config.php'; // Ensure this file contains the correct database connection

// Check if the skill ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Use a prepared statement to get skill details from the database
    $stmt = $conn->prepare("SELECT * FROM skills WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $skill = $result->fetch_assoc();
    } else {
        include '404.php';
        exit();
    }
} else {
    include '404.php';
    exit();
}

$stmt->close(); // Close the prepared statement
mysqli_close($conn); // Close the database connection
?>

<!-- HTML Form to edit the skill -->
<?php include './partials/layouts/layoutTop.php'; ?>

<form method="POST" action="update_skill.php">
    <!-- Skills Dropdown (Multi-select) -->
    <div class="mb-3">
        <label for="skills" class="form-label">Select Skills</label>
        <select class="form-select" id="skills" name="skills[]" multiple required>
            <option value="HTML" <?php if (strpos($skill['skills'], 'HTML') !== false) echo 'selected'; ?>>HTML</option>
            <option value="CSS" <?php if (strpos($skill['skills'], 'CSS') !== false) echo 'selected'; ?>>CSS</option>
            <option value="JavaScript" <?php if (strpos($skill['skills'], 'JavaScript') !== false) echo 'selected'; ?>>JavaScript</option>
            <!-- Add other skills as needed -->
        </select>
    </div>

    <!-- Proficiency Level Dropdown -->
    <div class="mb-3">
        <label for="proficiency" class="form-label">Proficiency Level</label>
        <select class="form-select" id="proficiency" name="proficiency_level" required>
            <option value="Beginner" <?php if ($skill['proficiency_level'] == 'Beginner') echo 'selected'; ?>>Beginner</option>
            <option value="Intermediate" <?php if ($skill['proficiency_level'] == 'Intermediate') echo 'selected'; ?>>Intermediate</option>
            <option value="Advanced" <?php if ($skill['proficiency_level'] == 'Advanced') echo 'selected'; ?>>Advanced</option>
            <option value="Expert" <?php if ($skill['proficiency_level'] == 'Expert') echo 'selected'; ?>>Expert</option>
        </select>
    </div>

    <!-- Status Dropdown -->
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="Active" <?php if ($skill['status'] == 'Active') echo 'selected'; ?>>Active</option>
            <option value="Inactive" <?php if ($skill['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
        </select>
    </div>

    <!-- Submit Button -->
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success px-5">Update Skill</button>
    </div>
</form>

<?php include './partials/layouts/layoutBottom.php'; ?>
