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
</head>
<body>
    <div class="bg-green-100 flex justify-center content-center h-full">
        <div class="flex flex-col bg-white h-auto m-auto p-3 rounded-md shadow">
            <a href="/" class="bg-red-300 p-1 rounded-md text-center text-red-500 hover:bg-red-200 hover:text-red-800">cancel</a>
            <h2 class="text-green-500 text-xl font-semibold text-center mb-2">
                Product Details
            </h2>

            <form action="/insert" method="POST">
                <label for="" class="text-sm">Product Name</label><br>
                <input type="text" name="product_name" class="border rounded-md p-2 mb-2"><br>

                <label for="" class="text-sm">Product Description</label><br>
                <textarea type="text" name="product_description" class="border rounded-md p-2 mb-2"></textarea><br>

                <label for="" class="text-sm">Product Price</label><br>
                <input type="number" name="product_price" class="border rounded-md p-2 mb-2"><br>

                <label for="" class="text-sm">Product Quantity</label><br>
                <input type="number" name="product_quantity" class="border rounded-md p-2 mb-2"><br>

                <button type="submit" class="text-center w-full bg-green-400 p-1 rounded-md">Add</button>
            </form>
        </div>
    </div>
</body>
</html>