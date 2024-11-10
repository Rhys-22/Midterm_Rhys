<?php
session_start();

// Initialize error messages
$emailError = "";
$passwordError = "";
$loginError = "";

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

    // If there are no validation errors, check credentials (simple demo validation here)
    if (empty($emailError) && empty($passwordError)) {
        // Demo: hardcoded email and password (replace this with a database query in a real app)
        if ($email === "rhys@email.com" && $password === "123456") {
            $_SESSION["loggedin"] = true;
            header("Location: welcome.php"); // Redirect to a welcome page
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
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Center the login form and adjust its size */
        body {
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align items to the top of the screen */
            min-height: 100vh;
            background-color: #f5f5f5;
            margin: 0;
            padding-top: 50px; /* Adjust padding to place the form near the top */
        }
        .login-container {
            width: 100%;
            max-width: 400px; /* Set maximum width for the login box */
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f8f9fa; /* Light gray background */
        }

        .card-header h3 {
            font-weight: normal;
            color: #343a40; /* Dark color for contrast with light gray background */
        }
        .alert {
            margin-bottom: 30px;
        }
        .alert ul li.password-error {
            padding-bottom: 20px;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <!-- Error Message -->
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

        <!-- Login Form -->
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

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
