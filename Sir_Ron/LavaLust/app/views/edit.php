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
    </style>
</head>
<body class="bg-light">

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="text-success text-center mb-4">User Details</h2>

                <a href="/" class="cancel text-decoration-none">Cancel</a>

                <form action="/user/update/<?= $user['id'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="<?= $user['crp_last_name'] ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" value="<?= $user['crp_first_name'] ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= $user['crp_email'] ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" name="gender" value="<?= $user['crp_gender'] ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" value="<?= $user['crp_address'] ?>" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-update w-100">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
