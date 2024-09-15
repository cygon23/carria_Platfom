<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php"); // Redirect to login if not logged in
    exit();
}

// Display the user's email
$user_data = $_SESSION['user_id'];
?>
<?php include './partials/sidebar.php';?>
<?php include './partials/layouts/layoutTop.php' ?>


<form method="POST" action="add_skill.php">
    <!-- Skills Dropdown (Multi-select) -->
    <div class="mb-3">
        <label for="skills" class="form-label">Select Skills</label>
        <select class="form-select" id="skills" name="skills[]" multiple required>
            <option value="HTML">HTML</option>
            <option value="CSS">CSS</option>
            <option value="JavaScript">JavaScript</option>
            <!-- Other skill options here -->
        </select>
    </div>

    <!-- Proficiency Level Dropdown -->
    <div class="mb-3">
        <label for="proficiency" class="form-label">Proficiency Level</label>
        <select class="form-select" id="proficiency" name="proficiency_level" required>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
            <option value="Expert">Expert</option>
        </select>
    </div>

    <!-- Status Dropdown -->
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>

    <!-- Submit Button -->
    <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-success px-5">Save Skill</button>
    <a href="edit_skill.php?id=<?php echo $skill['id']; ?>" class="btn btn-warning px-5 ms-3">Edit Skill</a>
    

</div>

</form>



<?php $script = '<script src="./assets/js/homeOneChart.js"></script>';?>
<?php include './partials/layouts/layoutBottom.php' ?>

