<?php
include "config.php"; // connect to database

// Check if ID is provided
if (!isset($_GET['id'])) {
    die("No booking selected for deletion.");
}

$id = (int) $_GET['id'];

// Delete the booking
$delete = mysqli_query($conn, "DELETE FROM bookings WHERE id = $id");

if ($delete) {
    // Redirect back to admin page
    header("Location: admin.php?deleted=1");
    exit;
} else {
    die("Error deleting booking.");
}
