<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="products.css">
    <title>Product Page</title>
</head>
<body>
                <form action="insert.php" method="POST" enctype="multipart/form-data">
                    <div class="top">
                        <p>Product Details:</p>
                    </div>
                    <div class="product-name">
                        <label for="pname">Product Name:</label>
                        <input type="text" id="pname" name="pname" placeholder="Enter Product Name"></div>
                    </div>

                    <div class="product-price">
                        <label for="pprice">Product Price:</label>
                        <input type="text" id="pprice" name="pprice" placeholder="Enter Product Price"></div>
                    </div>

                    <div class="product-image">
                        <label for="pimage">Add Product Image:</label>
                        <input type="file" id="pimage" name="pimage"></div>
                    </div>

                    <div class="product-stock">
                        <label for="pstock">Product Stock:</label>
                        <input type="text" id="pstock" name="pstock" placeholder="Enter Stock Amount"></div>
                    </div>

                    <div class="product-category">
                        <label for="pcat">Select Product Category:</label>
                        <select id="pcat" name="pcat">
                            <option selected>Select Category</option>
                            <option value="Laptop">Laptop</option>
                            <option value="Mobile">Mobile</option>
                            <option value="PC">PC</option>
                        </select>
                    </div>
                    <button name="submit" type="submit" class="upload">Upload</button>
                </form>

</body>
</html>