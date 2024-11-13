<?php
session_start();

// Initialize session array if not set
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// Handle new student submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    $studentID = $_POST['studentID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    // Check for duplicate student ID
    if (isset($_SESSION['students'][$studentID])) {
        $error = "Student ID already exists. Please use a unique ID.";
    } else {
        // Add student to session
        $_SESSION['students'][$studentID] = [
            'studentID' => $studentID,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'subjects' => []
        ];
        header("Location: register.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register a New Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Register a New Student</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="/root/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register Student</li>
            </ol>
        </nav>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Form to Register a Student -->
        <form method="POST" class="mb-4">
            <input type="hidden" name="action" value="register">
            <div class="mb-3">
                <label for="studentID" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="studentID" name="studentID" placeholder="Enter Student ID" required>
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>

        <!-- Student List Table -->
        <h3>Student List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['students'] as $id => $student) : ?>
                    <tr>
                        <td><?= htmlspecialchars($student['studentID']); ?></td>
                        <td><?= htmlspecialchars($student['firstName']); ?></td>
                        <td><?= htmlspecialchars($student['lastName']); ?></td>
                        <td>
                            <a href="edit.php?studentID=<?= urlencode($id); ?>" class="btn btn-info btn-sm">Edit</a>
                            <a href="delete.php?studentID=<?= urlencode($id); ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
