<?php
// Start session only if it hasn't started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rattiz Kitchen</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark px-3">
        <span class="navbar-brand">🍽️ Rattiz Kitchen</span>
        <div>
            <a href="index.php" class="text-white me-3">Home</a>
            <a href="booking.php" class="text-white me-3">Bookings</a>
            <a href="admin.php" class="text-white me-3">Admin</a>
            <a href="logout.php" class="text-white">Logout</a>
        </div>
    </nav>