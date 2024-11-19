<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cancel {
            color: #dc3545;
            margin-bottom: 20px;
            display: inline-block;
            font-weight: 600;
        }
        .cancel:hover {
            text-decoration: underline;
        }
        .btn-update {
            background-color: #198754;
            color: white;
            font-weight: 600;
        }
        .btn-update:hover {
            background-color: #157347;
        }
        .container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="text-success text-center mb-4">User Details</h2>

                <a href="/" class="cancel text-decoration-none">Cancel</a>

                <form id="editUserForm" action="/user/update/<?= $user['id'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="<?= $user['crp_last_name'] ?>" class="form-control" required>
                        <small class="error-message" id="last_name_error"></small>
                    </div>

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="<?= $user['crp_first_name'] ?>" class="form-control" required>
                        <small class="error-message" id="first_name_error"></small>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="<?= $user['crp_email'] ?>" class="form-control" required>
                        <small class="error-message" id="email_error"></small>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" name="gender" id="gender" value="<?= $user['crp_gender'] ?>" class="form-control" required>
                        <small class="error-message" id="gender_error"></small>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" value="<?= $user['crp_address'] ?>" class="form-control" required>
                        <small class="error-message" id="address_error"></small>
                    </div>

                    <button type="submit" class="btn btn-update w-100">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#editUserForm').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                // Clear previous error messages
                $('.error-message').text('');

                // Validate inputs
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

                // If the form is valid, send data via AJAX
                if (isValid) {
                    const formData = {
                        last_name: $('#last_name').val().trim(),
                        first_name: $('#first_name').val().trim(),
                        email: $('#email').val().trim(),
                        gender: $('#gender').val().trim(),
                        address: $('#address').val().trim()
                    };

                    $.ajax({
                        url: '/user/update/<?= $user["id"] ?>', // Use your route here
                        method: 'POST',
                        data: formData,
                        success: function (response) {
                            alert('User details updated successfully!');
                            // Optionally redirect or update the UI
                            window.location.href = '/';
                            console.log(response);
                        },
                        error: function (xhr, status, error) {
                            alert('An error occurred. Please try again.');
                            console.error(error);
                        }
                    });
                }
            });

            // Email validation function
            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
        });
    </script>

</body>
</html>
