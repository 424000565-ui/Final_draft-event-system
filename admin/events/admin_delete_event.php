<?php
// 1. FIXED: Points to the correct path where your database file actually lives
include("../../includes/db.php");

// Verify that an ID parameter exists before attempting to process database drops
if (isset($_GET['id'])) {
    
    // Sanitize input data parameters to keep your database operations structurally sound
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Execute the deletion record drop query
    mysqli_query($conn, "DELETE FROM events WHERE id='$id'");
}

// 2. FIXED: Redirects smoothly back to your actual management page name
header("Location: admin_events.php");
exit();
?>