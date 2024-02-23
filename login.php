<?php require("./required/config.php") ?>

<?php
if (isset($_POST['registerBtn'])) {
    $username = ucfirst($_POST['username']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($username) && !empty($email) && !empty($password)) {
        $sql = "INSERT INTO `users`(`username`, `email`, `password`) VALUES ('$username','$email','$password')";
        $run = $mysqli->query($sql);
        $swalScript = '
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "success",
            title: "REGISTER SUCCESSFULY YOU CAN LOGIN NOW",
        })
    });
</script>';
        echo $swalScript;
    } else {
        $swalScript = '
<script>
    // Wait for the DOM to be ready
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "FIELD CANNOT BE EMPTY",
        });
    });
</script>';
        echo $swalScript;
    }
}
if (isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $sql = "SELECT `username`, `email`,`password`,`id` FROM `users` WHERE `email` = '$email'";
        if ($mysqli->query($sql)->num_rows > 0) {
            $row = $mysqli->query($sql)->fetch_object();
            $checkpass = $row->password;
            if ($checkpass == $pass) {
                $_SESSION['username'] = $row->username;
                $_SESSION['LoggedIn'] = true;
                header("Location: index.php");
                exit();
            } else {
                $swalScript = '
<script>
    // Wait for the DOM to be ready
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "WRONG PASSWORD",
        });
    });
</script>';
                echo $swalScript;
            }
        } else {
            $swalScript = '
<script>
    // Wait for the DOM to be ready
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "WRONG EMAIL",
        });
    });
</script>';
            echo $swalScript;
        }
    } else {
        $swalScript = '
<script>
    // Wait for the DOM to be ready
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "FIELD CANNOT BE EMPTY",
        });
    });
</script>';
        echo $swalScript;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Register Form - CodeCraftedWeb</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div class="container">
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">
            <div class="login">
                <form method="post" class="form">
                    <label for="chk" aria-hidden="true">Log in</label>
                    <input class="input" type="email" name="email" placeholder="Email">
                    <input class="input" type="password" name="password" placeholder="Password">
                    <button name="loginBtn" type="submit">Log in</button>
                </form>
            </div>
            <div class="register">
                <form method="post" class="form">
                    <label for="chk" aria-hidden="true">Register</label>
                    <input class="input" type="text" name="username" placeholder="Username">
                    <input class="input" type="email" name="email" placeholder="Email">
                    <input class="input" type="password" name="password" placeholder="Password">
                    <button name="registerBtn" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>