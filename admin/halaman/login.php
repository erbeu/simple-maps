<?php
if(isset($_POST["username"])) {
    $q = mysqli_query($conn, "SELECT * FROM admin
        WHERE
        username = '".$_POST["username"]."' AND
        password = '".md5($_POST["password"])."'");
    
    if(mysqli_num_rows($q) == 1) {
        $d = mysqli_fetch_assoc($q);
        
        $_SESSION["id_admin"] = $d["id"];
        $_SESSION["username"] = $d["username"];
        
        header("location:index.php");
    } else {
        $error = "Username / Password Salah";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>LOGIN</title>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<style>
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
    }

    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }

    .form-signin .form-signin-heading {
        margin-bottom: 10px;
    }

    .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
</head>
<body>
<div class="container">

    <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading">Please log in</h2>

        <?php
        if(isset($error)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">".$error."</div>";
        }
        ?>

        <label for="username" class="sr-only">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
    </form>

</div>
</body>

</html>