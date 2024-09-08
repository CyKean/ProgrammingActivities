<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
include 'src/include.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

    <style>
        .alert {
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

    </style>
</head>
<body>
    <div class="bg-green-100 flex justify-center content-center h-full">
        <div class="flex flex-col bg-white h-auto m-4 p-3 rounded-md shadow">
            <h2 class="text-xl text-green-500 text-center font-semibold pb-2">
                Products
            </h2>

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

                <script>
                    setTimeout(function() {
                        let notificationMessages = document.querySelectorAll('.notifications');
                        notificationMessages.forEach(function(message) {
                            message.style.display = 'none';
                        });
                    }, 2000); 
                </script>
            <?php endif; ?>

            <a href="/add" class="text-center bg-green-500 rounded-md mb-2 text-white font-bold text-xl hover:bg-green-300">+</a>

           
            <table class="table table-auto border">
                <thead>
                    <th class="border border-green-300 p-2">ID</th>
                    <th class="border border-green-300 p-2">Product Name</th>
                    <th class="border border-green-300 p-2">Product Description</th>
                    <th class="border border-green-300 p-2">Product Price</th>
                    <th class="border border-green-300 p-2">Product Quantity</th>
                    <th class="border border-green-300 p-2">Actions</th>
                </thead>
        <?php if (!empty($products)): ?>
                <tbody>
                    <?php foreach($products as $row): ?>
                    <tr>
                        <td class="text-center border border-green-300 p-2"><?= $row['id']; ?></td>
                        <td class="text-center border border-green-300 p-2"><?= $row['product_name']; ?></td>
                        <td class="text-center border border-green-300 p-2"><?= $row['product_description']; ?></td>
                        <td class="text-center border border-green-300 p-2"><?= $row['product_price']; ?></td>
                        <td class="text-center border border-green-300 p-2"><?= $row['product_quantity']; ?></td>
                        <td class="text-center border border-green-300 p-2">
                            <a href="/edit/<?= $row['id']; ?>" class="bg-green-400 text-white rounded-md p-1">Edit</a>
                            <form action="/delete/<?= $row['id']; ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                <button type="submit" class="bg-red-400 text-white rounded-md p-1">Delete</button>
                            </form>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>



        </div>
    </div>
</body>
</html>