<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-In</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 m-auto bg-white shadow font=monospace border border-info">
                <p class="text-warning fs-2 fw-bold my-3 text-center">User Sign IN</p>
                <form action="login1.php" method="POST">
                    <div class="mb-3">
                        <label for="name">UserName:</label>
                        <input name='name' type="text" placeholder="Enter your name" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input name='password' type="password" placeholder="Enter your password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <button class="w-100 bg-danger fs-4 text-black">Login</button>
                    </div>
                    <div class="mb-3">
                        <button name='submit' class="w-100 bg-warning fs-4 text-white"><a href="register.php" class="text-decoration-none text-white">Sign-In</a></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>