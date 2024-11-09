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
        <div class="alert alert-danger d-none" id="errorAlert" role="alert">
            <div class="d-flex justify-content-between align-items-center">
                <span class="alert-heading">System Errors</span>
                <button type="button" class="btn-close" onclick="hideAlert()" aria-label="Close"></button>
            </div>
            <ul class="mb-0" id="errorMessages"></ul>
        </div>

        <!-- Login Form (Card structure from second code) -->
        <div class="card shadow-lg">
            <div class="card-header text-start">
                <h3>Login</h3>
            </div>
            <div class="card-body">
                <form onsubmit="validateForm(event)">
                    <!-- Email Address Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
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

    <!-- JavaScript for Form Validation -->
    <script>
        function validateForm(event) {
            event.preventDefault(); // Prevent form submission
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            const errorAlert = document.getElementById("errorAlert");
            const errorMessages = document.getElementById("errorMessages");

            // Clear previous errors
            errorMessages.innerHTML = '';

            // Check for validation errors
            if (!email || !password) {
                errorAlert.classList.remove("d-none");
                
                if (!email) {
                    const li = document.createElement('li');
                    li.textContent = "Email is required";
                    errorMessages.appendChild(li);
                }
                if (!password) {
                    const li = document.createElement('li');
                    li.textContent = "Password is required";
                    li.classList.add("password-error"); // Add class for padding
                    errorMessages.appendChild(li);
                }
            } else {
                errorAlert.classList.add("d-none");
                alert("Login successful!"); // Placeholder for successful login action
                // Proceed with form submission or further processing
            }
        }

        function hideAlert() {
            const errorAlert = document.getElementById("errorAlert");
            errorAlert.classList.add("d-none");
        }
    </script>
</body>
</html>
