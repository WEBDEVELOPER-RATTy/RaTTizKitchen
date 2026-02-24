<?php

include "config.php";
include "header.php";


// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}



/* =========================
   CHECK IF ID IS PROVIDED
   ========================= */
if (!isset($_GET['id'])) {
    echo "<div class='container mt-5 alert alert-danger'>
            No booking selected.
          </div>";
    include "footer.php";
    exit;
}

$id = (int) $_GET['id'];

/* =========================
   FETCH BOOKING DATA
   ========================= */
$result = mysqli_query($conn, "SELECT * FROM bookings WHERE id = $id");

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='container mt-5 alert alert-danger'>
            Booking not found.
          </div>";
    include "footer.php";
    exit;
}

$row = mysqli_fetch_assoc($result);

/* =========================
   HANDLE UPDATE
   ========================= */
if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $people = $_POST['people'];
    $message = $_POST['message'];

    $update = mysqli_query($conn, "
        UPDATE bookings SET
            name    = '$name',
            email   = '$email',
            date    = '$date',
            people  = '$people',
            message = '$message'
        WHERE id = $id
    ");

    if ($update) {
        echo "<div class='container mt-3 alert alert-success'>
                Booking updated successfully.
              </div>";

        // Refresh data after update
        $row = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT * FROM bookings WHERE id = $id")
        );
    } else {
        echo "<div class='container mt-3 alert alert-danger'>
                Update failed.
              </div>";
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">✏️ Edit Booking</h2>

    <form method="post">

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $row['email'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="<?= $row['date'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Number of People</label>
            <input type="number" name="people" class="form-control" value="<?= $row['people'] ?>" min="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" rows="4"><?= $row['message'] ?></textarea>
        </div>

        <button type="submit" name="update" class="btn btn-success">
            Update Booking
        </button>

        <a href="admin.php" class="btn btn-secondary ms-2">
            Back
        </a>

    </form>
</div>

<?php include "footer.php"; ?>