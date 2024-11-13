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
        <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/root/dashboard.php">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Register Student</li>
</ol>

        </nav>
        
        <div id="errorMessages" class="alert alert-danger d-none">
            <ul id="errorList"></ul>
        </div>

        <!-- Form to Register or Edit a Student -->
        <form id="studentForm" class="mb-4">
            <div class="mb-3">
                <label for="studentID" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="studentID" placeholder="Enter Student ID">
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" placeholder="Enter First Name">
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name">
            </div>
            <button type="button" class="btn btn-primary" id="addUpdateButton" onclick="addOrUpdateStudent()">Add Student</button>
        </form>

        <!-- Student List Table -->
        <h3>Student List</h3>
        <table class="table table-bordered" id="studentTable">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <!-- Rows will be added dynamically here -->
            </tbody>
        </table>
    </div>

    <script>
        let students = [];
        let editIndex = null;

        function addOrUpdateStudent() {
            const studentID = document.getElementById('studentID').value.trim();
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            
            const errorMessages = validateForm(studentID, firstName, lastName);
            if (errorMessages.length > 0) {
                displayErrors(errorMessages);
                return;
            } else {
                clearErrors();
            }
            
            if (editIndex === null) {
                // Check for duplicate ID before adding new student
                if (checkDuplicateID(studentID)) {
                    displayErrors(["Student ID already exists. Please use a unique ID."]);
                    return;
                }
                students.push({ studentID, firstName, lastName, subjects: [] });
            } else {
                // Check for duplicate ID before updating an existing student
                if (students[editIndex].studentID !== studentID && checkDuplicateID(studentID)) {
                    displayErrors(["Student ID already exists. Please use a unique ID."]);
                    return;
                }
                students[editIndex] = { studentID, firstName, lastName, subjects: students[editIndex].subjects };
                editIndex = null;
                document.getElementById('addUpdateButton').innerText = 'Add Student';
            }

            resetForm();
            renderStudentTable();
        }

        function checkDuplicateID(studentID) {
            return students.some((student, index) => student.studentID === studentID && index !== editIndex);
        }

        function validateForm(studentID, firstName, lastName) {
            const errors = [];
            if (!studentID) errors.push("Student ID is required");
            if (!firstName) errors.push("First Name is required");
            if (!lastName) errors.push("Last Name is required");
            return errors;
        }

        function displayErrors(errors) {
            const errorMessages = document.getElementById('errorMessages');
            const errorList = document.getElementById('errorList');
            errorList.innerHTML = '';
            errors.forEach(error => {
                const li = document.createElement('li');
                li.innerText = error;
                errorList.appendChild(li);
            });
            errorMessages.classList.remove('d-none');
        }

        function clearErrors() {
            document.getElementById('errorMessages').classList.add('d-none');
            document.getElementById('errorList').innerHTML = '';
        }

        function resetForm() {
            document.getElementById('studentID').value = '';
            document.getElementById('firstName').value = '';
            document.getElementById('lastName').value = '';
        }

        function renderStudentTable() {
            const tbody = document.getElementById('studentTableBody');
            tbody.innerHTML = '';

            students.forEach((student, index) => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${student.studentID}</td>
                    <td>${student.firstName}</td>
                    <td>${student.lastName}</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="editStudent(${index})">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteStudent(${index})">Delete</button>
                    </td>
                `;

                tbody.appendChild(row);
            });
        }

        function editStudent(index) {
            const student = students[index];
            document.getElementById('studentID').value = student.studentID;
            document.getElementById('firstName').value = student.firstName;
            document.getElementById('lastName').value = student.lastName;

            editIndex = index;
            document.getElementById('addUpdateButton').innerText = 'Update Student';
        }

        function deleteStudent(index) {
            students.splice(index, 1);
            renderStudentTable();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
