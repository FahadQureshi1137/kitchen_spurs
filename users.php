<?php require("./required/config.php") ?>
<?php
if (!isset($_SESSION['LoggedIn'])) {
    header("Location:login.php");
    exit();
}
if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($username) && !empty($email) && !empty($password)) {
        $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sss", $username, $email, $password);
            $stmt->execute();
            $stmt->close();
            header('Location: users.php');
            exit();
        } else {
            echo "Error: " . $mysqli->error;
        }
    } else {
        echo "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchen Spurs</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="index.php" class="brand">
            <i class="bx bxs-smile"></i>
            <span class="text">Kitchen Spurs</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="index.php">
                    <i class="bx bxs-dashboard"></i>
                    <span class="text">Task</span>
                </a>
            </li>
            <li>
                <a href="users.php">
                    <i class="bx bxs-shopping-bag-alt"></i>
                    <span class="text">Users</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <?php if (isset($_SESSION['LoggedIn'])) { ?>
                <li>
                    <a href="logout.php">
                        <i class="bx bxs-log-out-circle"></i>
                        <span class="text">Logout</span></a>
                </li>
            <?php } ?>
        </ul>
    </section>
    <!-- SIDEBAR -->


    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav class=" d-flex justify-content-between">
            <div class="d-flex">
                <i class="bx bx-menu my-auto"></i>
                <a href="#" class="nav-link">Categories</a>
            </div>
            <div class="">
                <a href="#" class="profile">
                    Welcome! &nbsp;
                    <span class="fw-bold">
                        <?php
                        $username = $_SESSION['username'];
                        echo $username;
                        ?>
                    </span>
                </a>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <!-- ADD USERS -->
            <div class="text-end m-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addUsermodelId">
                    Add User
                </button>
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="addUsermodelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <!-- Username -->
                                    <div class="mb-3">
                                        <div class="text-start">
                                            <label for="" class="form-label">Username</label>
                                        </div>
                                        <input type="text" class="form-control" name="username" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                    <!-- Username -->
                                    <!-- Email -->
                                    <div class="mb-3">
                                        <div class="text-start">
                                            <label for="" class="form-label">Email</label>
                                        </div>
                                        <input type="email" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                    <!-- Email -->
                                    <!-- Password -->
                                    <div class="mb-3">
                                        <div class="text-start">
                                            <label for="" class="form-label">Password</label>
                                        </div>
                                        <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" placeholder="">
                                    </div>
                                    <!-- Password -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" value="addUser" name="addUser" class="btn btn-primary">Add User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
            </div>
            <!-- ADD USERS -->
            <!--ALL Users  -->
            <div class="table-responsive">
                <table class="table table-secondary">
                    <thead>
                        <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">CreatedOn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- READ_USER [SELECT] -->
                        <?php
                        $read_user = "SELECT * FROM `users` WHERE `isDeleted` = '0'";
                        $result = $mysqli->query($read_user);
                        if ($result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_object()) {
                        ?>
                                <!-- READ_USER [SELECT] -->
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row->username ?></td>
                                    <td><?= $row->email ?></td>
                                    <td><?= $row->createdOn ?></td>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--ALL Users  -->
        </main>
        <!-- MAIN -->
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- CONTENT -->
    <script src="script.js"></script>
</body>

</html>