<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-label {
            font-weight: 600;
        }
        .cancel {
            text-decoration: none;
            color: #ff0000;
            margin-bottom: 20px;
            display: inline-block;
        }
        .cancel:hover {
            text-decoration: underline;
        }
        .btn {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
            <h2 class="mb-4">Add User</h2>
            <a href="/" class="cancel">Cancel</a>

            <form id="addUserForm" action="/insert" method="POST">
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" required>
                    <small class="error-message" id="last_name_error"></small>
                </div>

                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" required>
                    <small class="error-message" id="first_name_error"></small>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                    <small class="error-message" id="email_error"></small>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <input type="text" name="gender" class="form-control" id="gender" required>
                    <small class="error-message" id="gender_error"></small>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" required>
                    <small class="error-message" id="address_error"></small>
                </div>

                <button type="submit" class="btn btn-primary w-100">Add</button>
            </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#addUserForm').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                // Clear any previous error messages
                $('.error-message').text('');

                // Validate form fields
                let isValid = true;

                if ($('#last_name').val().trim() === '') {
                    $('#last_name_error').text('Last name is required.');
                    isValid = false;
                }
                if ($('#first_name').val().trim() === '') {
                    $('#first_name_error').text('First name is required.');
                    isValid = false;
                }
                if ($('#email').val().trim() === '') {
                    $('#email_error').text('Email is required.');
                    isValid = false;
                } else if (!validateEmail($('#email').val().trim())) {
                    $('#email_error').text('Invalid email format.');
                    isValid = false;
                }
                if ($('#gender').val().trim() === '') {
                    $('#gender_error').text('Gender is required.');
                    isValid = false;
                }
                if ($('#address').val().trim() === '') {
                    $('#address_error').text('Address is required.');
                    isValid = false;
                }

                // If the form is valid, send the data via AJAX
                if (isValid) {
                    $.ajax({
                        url: '/insert', // Backend endpoint
                        type: 'POST',
                        data: {
                            last_name: $('#last_name').val(),
                            first_name: $('#first_name').val(),
                            email: $('#email').val(),
                            gender: $('#gender').val(),
                            address: $('#address').val()
                        },
                        success: function (response) {
                            // Handle success response
                            alert('User added successfully!');
                            console.log(response); // You can log the response for debugging
                            window.location.href = '/'; // Redirect after successful submission
                        },
                        error: function (xhr) {
                            // Handle error response
                            alert('An error occurred while adding the user.');
                            console.error(xhr.responseText); // Log error response for debugging
                        }
                    });
                }
            });

            // Function to validate email format
            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
        });
    </script>

</body>
</html>
