<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<header>
        <h2><abbr title="hariom kumar sharma">hariom</abbr></h2>
        
        <?php 
        if (isset($_SESSION['logedin'])) {
            echo "<nav>
            <a href='index.php'>Home</a>
            <a href=\"product.php\">Products</a>
            <a href=\"#\">Contact</a>
            <a href=\"#\">About</a>
        </nav>";
        }else{
             echo "<nav>
             <a href='index.php'>Home</a>
             
             <a href=\"#\">Contact</a>
             <a href=\"#\">About</a>
         </nav>";
        }
        ?>

        <?php 
        if (isset($_SESSION['logedin'])) {
            echo "
            <div class='name'>
            $_SESSION[name] <button><a href='logout.php'>LOGOUT</a></button>
            </div>
            ";
        }else{
             echo "<div class='sing-in-up'>
            <button type='button' onclick=\"popup('login-popup');\" id='login'>Login</button>
            <button type='button' onclick=\"popup('register-popup');\">Register</button>
        </div>";
        }
        ?>
       
    </header>
</body>
</html>