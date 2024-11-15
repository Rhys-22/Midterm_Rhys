<?php
session_start();
if (isset($_SESSION['email'])) {
    // If logged in, redirect to dashboard
    header('Location: dashboard.php');
    exit;
}
// Initialize error messages
$emailError = "";
$passwordError = "";
$loginError = "";

// Define an array of valid email and password pairs
$validCredentials = [
    "rhys@email.com" => "123456",
    "jane.doe@email.com" => "password123", // Add more emails and passwords as needed
    "admin@email.com" => "adminpass"
];

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validate email
    if (empty($email)) {
        $emailError = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email";
    }

    // Validate password
    if (empty($password)) {
        $passwordError = "Password is required";
    }

    // If there are no validation errors, check credentials
    if (empty($emailError) && empty($passwordError)) {
        // Check if the email exists in the validCredentials array
        if (array_key_exists($email, $validCredentials) && $validCredentials[$email] === $password) {
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email; // Store the email in the session
            header("Location: dashboard.php"); // Redirect to the dashboard
            exit();
        } else {
            $loginError = "Incorrect email or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Midtermtest</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Center the login form and adjust its size */
        body {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            background-color: #f5f5f5;
            margin: 0;
            padding-top: 50px;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f8f9fa;
        }
        .card-header h3 {
            font-weight: normal;
            color: #343a40;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php if (!empty($emailError) || !empty($passwordError) || !empty($loginError)): ?>
            <div class="alert alert-danger">
                <strong>System Errors</strong>
                <ul class="mb-0">
                    <?php if ($emailError) echo "<li>$emailError</li>"; ?>
                    <?php if ($passwordError) echo "<li>$passwordError</li>"; ?>
                    <?php if ($loginError) echo "<li>$loginError</li>"; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card shadow-lg">
            <div class="card-header text-start">
                <h3>Login</h3>
            </div>
            <div class="card-body">
                <form method="POST" id="login-form">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
