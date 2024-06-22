<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 m-auto bg-white shadow font=monospace border border-info">
                <p class="text-warning fs-2 fw-bold my-3 text-center">User Sign IN</p>
                <form action="insert.php" method="POST">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input name='name' type="text" placeholder="Enter your name" class="form-control" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input name='email' type="text" placeholder="Enter email:" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="pNumber">Phone Number:</label>
                        <input name='pNumber' type="text" pattern="[0-9]+" placeholder="Enter your phone number" class="form-control" id="pNumber">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input name='password' type="password" placeholder="Enter your password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <button name='submit' class="w-100 bg-warning fs-4 text-white">Sign-In</button>
                    </div>
                    <div class="mb-3">
                        <button class="w-100 bg-danger fs-4 text-black"><a href="login.php" class="text-decoration-none text-black">Login</a></button>
                    </div>
                    <div class="mb-3">
                        <button name='submit' class="w-100 bg-success fs-4 text-white"><a href="../index.php" class="text-decoration-none text-white">Home Page</a></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>