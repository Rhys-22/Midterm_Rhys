<?php
// Start the session to store user data
session_start();

// Predefined users (email => password)
$users = [
    'rhys@email.com' => '12345678',
    'steve@email.com' => '12345678',
    'justine@email.com' => '12345678',
    'balote@email.com' => '12345678',
    'faiyaz@email.com' => '12345678',
];

// Initialize variables
$email = $password = '';
$emailErr = $passwordErr = '';
$errorDetails = [];
$loginError = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email
    if (empty($email)) {
        $emailErr = 'Email is required.';
        $errorDetails[] = $emailErr; // Add error to details array
    }

    // Validate password
    if (empty($password)) {
        $passwordErr = 'Password is required.';
        $errorDetails[] = $passwordErr; // Add error to details array
    }

    // Check if both email and password are provided
    if (empty($emailErr) && empty($passwordErr)) {
        // Check if email exists in predefined users
        if (array_key_exists($email, $users)) {
            // Check if password matches the one in the array
            if ($users[$email] === $password) {
                // Successful login, store user email in session
                $_SESSION['email'] = $email;
                // Redirect to the dashboard
                header('Location: dashboard.php');
                exit;
            } else {
                $errorDetails[] = 'Password is incorrect.';
            }
        } else {
            $errorDetails[] = 'Email not found.';
        }
    }

    // If there are errors, set the login error message
    if (!empty($errorDetails)) {
        $loginError = 'System Errors:';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Center the login form horizontally, align it at the top */
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
            max-width: 400px;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        /* Set light gray background for the card header */
        .card-header {
            background-color: #f8f9fa; /* Light gray background */
        }
        .card-header h3 {
            font-weight: normal;
            color: #343a40; /* Dark color for contrast with light gray background */
        }
        .alert-heading {
            font-weight: bold;
            font-size: 1.1rem;
        }
        .alert {
            margin-bottom: 20px;
            padding: 15px;
            padding-bottom: 2px;
        }
        /* Additional padding under the last error message */
        .alert ul li.password-error {
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Error Alert (Separate from Login Box) -->
        <?php if (!empty($loginError)): ?>
            <div id="error-box" class="alert alert-danger" role="alert">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="alert-heading">System Errors</span>
                    <button type="button" class="btn-close" onclick="hideAlert()" aria-label="Close"></button>
                </div>
                <ul class="mb-0" id="errorMessages">
                    <?php foreach ($errorDetails as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Login Form (Card structure) -->
        <div class="card shadow-lg">
            <div class="card-header text-start">
                <h3>Login</h3>
            </div>
            <div class="card-body">
                <form method="POST" id="login-form">
                    <!-- Email Address Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter email">
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function hideAlert() {
            const errorAlert = document.getElementById("error-box");
            errorAlert.classList.add("d-none");
        }
    </script>
</body>
</html>
