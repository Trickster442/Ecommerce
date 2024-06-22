<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
<form action="login1.php" method="POST">
                    <div class="top">
                        <h1>Login</h1>
                    </div>

                    <div class="email"> 
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" placeholder="Enter email" required></div>
                    </div>

                    <div class="password">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required></div>
                    </div>
                    <button type="submit" class="upload">Login</button>
                    <button class="homepage"><a href="../../users/index.php">Home</a></button>
                </form>
</body>
</html>