    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f8f9fa;
            }
            .container {
                margin-top: 20px;
            }
            .table {
                background-color: white;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }
            .add-btn {
                margin-bottom: 20px;
                float: right;
            }
            .notifications {
                margin-bottom: 20px;
            }
            .alert {
                font-size: 0.9rem;
            }
            .pagination {
                display: flex;
                justify-content: center;
            }
            .pagination li {
                margin: 0 5px;
            }
            th, td {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card p-4">
                <h2 class="mb-4">User List</h2>

                <?php if (isset($notifications) && !empty($notifications)): ?>
                    <div class="notifications">
                        <?php if (isset($notifications['success'])): ?>
                            <div class="alert alert-success">
                                <?php foreach($notifications['success'] as $success): ?>
                                    <p><?php echo $success; ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($notifications['error'])): ?>
                            <div class="alert alert-danger">
                                <?php foreach($notifications['error'] as $error): ?>
                                    <p><?php echo $error; ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <a href="/user/add" class="btn btn-primary add-btn">Add User</a>

                <form id="search" action="/user/search" method="post" class="input-group mb-4">
                    <input type="text" name="query" id="query" class="form-control" placeholder="Search users..." required>
                    <button type="submit" class="btn btn-secondary">Search</button>
                </form>

                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php if (!empty($users)): ?>
                        <tbody>
                            <?php foreach($users as $row): ?>
                            <tr>
                                <td><?= $row['crp_last_name']; ?></td>
                                <td><?= $row['crp_first_name']; ?></td>
                                <td><?= $row['crp_email']; ?></td>
                                <td><?= $row['crp_gender']; ?></td>
                                <td><?= $row['crp_address']; ?></td>
                                <td>
                                    <a href="/user/edit/<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id']; ?>">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <nav>
                        <ul class="pagination">
                            <?php if ($current_page > 1): ?>
                                <li class="page-item"><a href="?page=<?= $current_page - 1 ?>" class="page-link">Previous</a></li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                    <a href="?page=<?= $i ?>" class="page-link"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item"><a href="?page=<?= $current_page + 1 ?>" class="page-link">Next</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <?php else: ?>
                    <p class="text-center">No users found.</p>
                    <?php endif; ?>
                </table>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
           $(document).ready(function() {
            // Hide notifications after 2 seconds
            setTimeout(function() {
                $('.notifications').fadeOut('slow');
            }, 2000);

            // Handle Delete action with confirmation modal
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                const userId = $(this).data('id');
                const deleteUrl = '/delete/' + userId;

                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: deleteUrl,
                        method: 'POST',
                        success: function(response) {
                            alert('User deleted successfully.');
                            location.reload(); // Reload the page to update the user list
                        },
                        error: function() {
                            alert('Error deleting user.');
                        }
                    });
                }
            });

        });
        </script>
    </body>
    </html>
