<?php

include "config.php";
include "header.php";

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}



if (isset($_GET['deleted'])) {
    echo "<div class='container mt-3 alert alert-success'>
            Booking deleted successfully.
          </div>";
}


// Fetch all bookings
$sql = "SELECT * FROM bookings ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">
    <h2 class="mb-4">📋 Booking List (Admin)</h2>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Number of People</th>
                <th>Message</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?= $row['id'] ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($row['name']) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($row['email']) ?>
                        </td>
                        <td>
                            <?= $row['date'] ?>
                        </td>
                        <td>
                            <?= $row['people'] ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($row['message']) ?>
                        </td>
                        <td>
                            <?= $row['created_at'] ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this booking?');">
                                Delete
                            </a>
                        </td>

                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">
                        No bookings found
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>