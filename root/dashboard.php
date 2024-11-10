<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// Set a default value for email if it's not set in the session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "Unknown User";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Extend the button width and center it */
        .btn-long {
            width: 100%; /* Make buttons take the full width of the card body */
            padding: 12px;
            font-size: 18px;
        }

        /* Position the logout button to the top-right of the card, higher up */
        .logout-btn {
            position: absolute;
            top: -90px;  /* Adjust distance from top (set to 0 to move higher) */
            right: 0px; /* Adjust distance from right */
        }

        /* Ensure the card has enough space for the absolute positioning */
        .card {
            position: relative;
            margin-top: 30px;
        }

        /* Add padding to the top of the card header */
        .card-header {
            padding-bottom: 30px;  /* Adjust this value for desired padding */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3>Welcome to the System: <?php echo htmlspecialchars($email); ?></h3>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Add a Subject</div>
                    <div class="card-body text-center">
                        <p>This section allows you to add a new subject in the system.</p>
                        <a href="add_subject.php" class="btn btn-primary btn-long">Add Subject</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Register a Student</div>
                    <div class="card-body text-center">
                        <!-- Logout Button positioned at top-right, higher -->
                        <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>
                        <p>This section allows you to register a new student in the system.</p>
                        <a href="register_student.php" class="btn btn-primary btn-long">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
