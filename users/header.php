<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <script src="https://kit.fontawesome.com/487ae9d97a.js" crossorigin="anonymous"></script>
    <title>User</title>
</head>
<body>

<header>
            <nav class="top">
                <div class="logo">
                   <a href="index.php">
                    Logo
                   </a> 
                </div>
                <form class="search-form">
                    <input type="text" placeholder="Search...">
                    <input type="submit" name="submit" value="submit">    
                </form>
                <div class="cart">

                    <a href="viewCart.php"><i class="fa-solid fa-cart-shopping"></i>Cart</a>
                </div>
                <div class="navigation-section">
                    <ul class="navigation-button">
                        <a href="#"><li><i class="fa-solid fa-user-shield"></i>Hello, 
                        <?php
                           session_start();

                           if (isset($_SESSION['user'])){
                            echo $_SESSION["user"];
                            echo" | ";
                            echo"
                            <li>
                            <a href='login/logout.php'>Logout</a>
                            </li>
                            ";
                           } else{
                            echo"
                            <li>
                            <a href='login/register.php'>Login</a>
                            </li>
                            ";
                           }
                            
                        ?>
                        
                        </li></a>
                        
                        <a href="../admin/isAdmin.php"><li>Admin</li></a>
                    </ul>
                </div>
                
            </nav>
        </div>
    </header>

    <div class="nav-category">
        <ul class="category-types">

        
    <?php
        include "config.php";
        $sql = "SELECT * FROM `category` WHERE status = 'active'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<li value='{$row['category_name']}'><a href='{$row['category_name']}.php'>{$row['category_name']}</a></>";
        }
        ?>

        </ul>
    </div>
</body>
</html>

